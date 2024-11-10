<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function get_ip_address_details(){
        $ipAddress = $this->request->getIPAddress();

        $ipInfo = file_get_contents("https://ipinfo.io/$ipAddress/json");
        $details = json_decode($ipInfo);

        if (isset($details->loc)) {
            list($latitude, $longitude) = explode(',', $details->loc);
            $region = $details->region;
            $city = $details->city;
        } else {
            $latitude = null;
            $longitude = null;
            $region = null;
            $city = null;
        }
    
        $data = array(
            'latitude' => $latitude,
            'longitude' => $longitude,
            'region' => $region,
            'city' => $city
        );
    
        echo json_encode($data);
        
    }

    public function save_farmer_details(){
        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'mobileNo' => $this->request->getPost('mobileNo'),
            'email' => $this->request->getPost('email'),
            'location' => $this->request->getPost('location'),
            'noOfAnimals' => $this->request->getPost('noOfAnimals'),
            'typeOfLiveStock' => $this->request->getPost('typeOfLiveStock'),
            'ttlValueAnimals' => $this->request->getPost('ttlValueAnimals')
        ];

        print($data);
    }
}
