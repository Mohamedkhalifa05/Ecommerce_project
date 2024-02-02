<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    //
    public function Agent_Dashboard(){


        return view("agent.agent_dashboard");

    }// End Method


    public function agent_login() {

 return view("agent.agent_login");

    }//End Method

    public function agent_register(Request $request) {
        
    }
}
