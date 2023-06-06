<?php

namespace App\Services\SyncUsersService;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SyncUsersService
{
    private ?string $sourceUrl;

    public function __construct() {
        $this->sourceUrl = config('sync-user.source_url');
    }

    /**
     * @return array|array[]|bool[]|string[]
     * @throws \JsonException
     */
    public function sync(): array
    {
        $updatedCount = 0;
        $createdCount = 0;

        $apiRequestService = resolve('api_request');
        $users = $apiRequestService->setMethod('get')->setUrl($this->sourceUrl)->execute();

        if (!$users) {
            return ['result' => false, 'message' => $apiRequestService->getErrorMessage()];
        }

        if ($users && is_array($users)) {
            foreach ($users as $user) {
                $data = $this->prepareData($user);

                if ($user = User::where('source_id', $user['id'] ?? null)->first()) {
                    $user->update($data);
                    $updatedCount++;
                } else {
                    User::create($data);
                    $createdCount++;
                }
            }
        }

        return array_merge([
            'result' => true,
            'message' => "Created $createdCount / Updated $updatedCount users"
        ], compact('updatedCount', 'createdCount'));
    }

    /**
     * @param array $data
     * @return array
     */
    public function prepareData(array $data): array
    {
        $address = $data['address'] ?? [];
        $company = $data['company'] ?? [];
        $data = collect($data)->map(function($item) {
            if (is_array($item)) {
                return collect($item)->map(fn($i) => is_array($i) ? $i : Str::limit($i, 255));
            } else {
                return Str::limit($item, 255);
            }
        });

        return $data->only(['name', 'email', 'username', 'phone', 'website'])->merge([
                'password' => Hash::make(\Str::password()),
                'source_id' => $data['id'] ?? null,
                'street' => $address['street'] ?? null,
                'suite' => $address['suite'] ?? null,
                'city' => $address['city'] ?? null,
                'zipcode' => $address['zipcode'] ?? null,
                'lat' => $address['lat'] ?? null,
                'lng' => $address['lng'] ?? null,
                'company_name' => $company['name'] ?? null,
                'company_catch_phrase' => $company['catchPhrase'] ?? null,
                'company_bs' => $company['bs'] ?? null
            ])->toArray();
    }
}
