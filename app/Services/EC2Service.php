<?php

namespace App\Services;

use Aws\Ec2\Ec2Client;

class EC2Service
{
    protected $ec2Client;

    public function __construct()
    {
        $this->ec2Client = new Ec2Client([
            'region'  => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    }

    // Start EC2 instance
    public function startInstance($instanceId)
    {
        return $this->ec2Client->startInstances([
            'InstanceIds' => [$instanceId],
        ]);
    }

    // Stop EC2 instance
    public function stopInstance($instanceId)
    {
        return $this->ec2Client->stopInstances([
            'InstanceIds' => [$instanceId],
        ]);
    }

    // List all EC2 instances
    public function listInstances()
    {
        $result = $this->ec2Client->describeInstances();
        $instances = [];

        foreach ($result['Reservations'] as $reservation) {
            foreach ($reservation['Instances'] as $instance) {
                $instances[] = [
                    'id' => $instance['InstanceId'],
                    'state' => $instance['State']['Name'],
                    'type' => $instance['InstanceType'],
                    'public_dns' => $instance['PublicDnsName'],
                    'launch_time' => $instance['LaunchTime'],
                ];
            }
        }

        return $instances;
    }

    // Generate RDP file content for a specific instance
    public function getInstanceRdp($instanceId, $username = 'Administrator')
    {
        $result = $this->ec2Client->describeInstances([
            'InstanceIds' => [$instanceId],
        ]);

        $instance = $result['Reservations'][0]['Instances'][0];
        $publicDns = $instance['PublicDnsName'];

        $rdpContent = "
            full address:s:$publicDns
            prompt for credentials:i:1
            username:s:$username
            administrative session:i:1
        ";

        return $rdpContent;
    }
}
