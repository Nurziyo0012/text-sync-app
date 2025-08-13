<?php

namespace App\Services;

use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;

class GoogleSheetService
{
    protected $client;
    protected $service;
    protected $spreadsheetId;

    public function __construct()
    {
        $this->spreadsheetId = config('services.google.sheet_id');

        $this->client = new Google_Client();
        $this->client->setApplicationName('Laravel Google Sheets');
        $this->client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
        $this->client->setAuthConfig(config('services.google.credentials_path'));
        $this->service = new Google_Service_Sheets($this->client);
    }

    public function write(array $values, string $range = 'Sheet1!A1')
    {
        $body = new \Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);

        $params = ['valueInputOption' => 'RAW'];
        return $this->service->spreadsheets_values->update(
            $this->spreadsheetId,
            $range,
            $body,
            $params
        );
    }
}