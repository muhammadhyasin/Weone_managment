<?php

namespace App\Http\Controllers;

use App\Services\EC2Service;
use Illuminate\Http\Request;

class EC2Controller extends Controller
{
    protected $ec2Service;

    public function __construct(EC2Service $ec2Service)
    {
        $this->ec2Service = $ec2Service;
    }

    // Display all instances in a table
    public function listInstances()
    {
        $instances = $this->ec2Service->listInstances();
        return view('ec2.instances', compact('instances'));
    }

    // Start a specific instance
    public function startInstance($id)
    {
        $this->ec2Service->startInstance($id);
        return redirect()->route('ec2.list')->with('status', 'Instance started successfully.');
    }

    // Stop a specific instance
    public function stopInstance($id)
    {
        $this->ec2Service->stopInstance($id);
        return redirect()->route('ec2.list')->with('status', 'Instance stopped successfully.');
    }

    // Download RDP file for a specific instance
    public function downloadRdp($id)
    {
        $rdpContent = $this->ec2Service->getInstanceRdp($id);
        return response($rdpContent, 200, [
            'Content-Type' => 'application/rdp',
            'Content-Disposition' => 'attachment; filename="instance_' . $id . '.rdp"',
        ]);
    }
    public function getInstanceStatuses()
    {
        $instances = $this->ec2Service->listInstances();
        return response()->json($instances);
    }

}
