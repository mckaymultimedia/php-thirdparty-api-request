<?PHP class ThirdPartyApiRequest {
    private $apiUrl;
    private $queryParams;

    public function __construct($apiUrl, $queryParams = []) {
        $this->apiUrl = $apiUrl;
        $this->queryParams = $queryParams;
    }

    public function sendRequest() {
        $url = $this->apiUrl;

        if (!empty($this->queryParams)) {
            $url .= '?' . http_build_query($this->queryParams);
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle any curl errors here
            echo 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);

        return $response;
    }
}

// Example usage:
$apiUrl = 'https://api.example.com/data'; // Replace with the actual API URL
$queryParams = [
    'param1' => 'value1',
    'param2' => 'value2',
];

$apiRequest = new ThirdPartyApiRequest($apiUrl, $queryParams);
$response = $apiRequest->sendRequest();

// Handle and process the response as needed
