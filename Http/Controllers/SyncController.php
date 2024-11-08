<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SyncController extends Controller
{
    protected $pipeDriveController;
    protected $evoTalksController;

    public function __construct(PipeDriveController $pipeDriveController, EvoTalksController $evoTalksController)
    {
        $this->pipeDriveController = $pipeDriveController;
        $this->evoTalksController = $evoTalksController;
    }

    public function syncCreatedOpportunityFromPipeDrive(Request $request)
    {
        $pipeDriveData = $request->input('current');

        $fkPipeline = ($pipeDriveData['pipeline_id'] == 3) ? 1 : $pipeDriveData['pipeline_id'];

        $evoData = new Request([
            'title' => $pipeDriveData['title'] ?? '',
            'value' => $pipeDriveData['value'] ?? 0,
            'recurrentvalue' => $pipeDriveData['recurrentvalue'] ?? 0,
            'mainmail' => $pipeDriveData['person_id']['email'][0]['value'] ?? '',
            'mainphone' => $pipeDriveData['person_id']['phone'][0]['value'] ?? '',
            'clientid' => $pipeDriveData['person_id']['name'] ?? '',
            'fkStage' => $pipeDriveData['stage_id'] ?? null,
            'fkPipeline' => $fkPipeline,
            'responsableid' => $pipeDriveData['user_id']['id'] ?? null,
            'expectedclosedate' => $pipeDriveData['expected_close_date'] ?? null,
            'status' => $pipeDriveData['status'] === 'won' ? 1 : 0,
            'description' => $pipeDriveData['last_activity']['note'] ?? '',
            'formattedlocation' => $pipeDriveData['org_id']['name'] ?? '',
        ]);

        return $this->evoTalksController->createOpportunity($evoData);
    }

    public function syncUpdatedOpportunityFromPipeDrive(Request $request)
    {
        $pipeDriveData = $request->input('current');

        $fkPipeline = ($pipeDriveData['pipeline_id'] == 3) ? 1 : $pipeDriveData['pipeline_id'];

        $evoData = new Request([
            'id' => $pipeDriveData['id'],
            'title' => $pipeDriveData['title'] ?? '',
            'value' => $pipeDriveData['value'] ?? 0,
            'recurrentvalue' => $pipeDriveData['recurrentvalue'] ?? 0,
            'mainmail' => $pipeDriveData['person_id']['email'][0]['value'] ?? '',
            'mainphone' => $pipeDriveData['person_id']['phone'][0]['value'] ?? '',
            'clientid' => $pipeDriveData['person_id']['name'] ?? '',
            'fkStage' => $pipeDriveData['stage_id'] ?? null,
            'fkPipeline' => $fkPipeline,
            'responsableid' => $pipeDriveData['user_id']['id'] ?? null,
            'expectedclosedate' => $pipeDriveData['expected_close_date'] ?? null,
            'status' => $pipeDriveData['status'] === 'won' ? 1 : 0,
            'description' => $pipeDriveData['last_activity']['note'] ?? '',
            'formattedlocation' => $pipeDriveData['org_id']['name'] ?? '',
        ]);

        return $this->evoTalksController->updateOpportunity($evoData);
    }
}
