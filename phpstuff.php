<?php
namespace rg\modules\jobs\actions;

use rg\core\base\annotations\internal;
use rg\core\base\dataTypes\IntType;
use rg\core\communication\JsonResponse;
use rg\core\pow\PreparableAction;
use rg\core\pow\requirements\EntityRequirement;
use rg\core\pow\requirements\RequestDataRequirement;
use rg\core\pow\requirements\Requirement;
use rg\core\Request;
use rg\model\accounts\account\AccountService;
use rg\model\accounts\entities\Account;

/**
 * @copyright ResearchGate GmbH
 */
class CoreTaggingFeedback extends PreparableAction {

    protected $allowedRenderingContexts = array(
        PreparableAction::RENDERING_CONTEXT_HTML, PreparableAction::RENDERING_CONTEXT_AJAX
    );

    /**
     * @var Account
     */
    public $account;

    /**
     * @var int
     */
    public $accountId;

    /**
     * @var Job
     */
    public $job;

    /**
     * @var int
     */
    public $jobId;

    /**
     * @internal
     */

    public function collect() {
        yield [
            new RequestDataRequirement(
                $this->properties->jobId
            )
        ];
//        yield [
//            new EntityRequirement(
//                $this->properties->account,
//                Account::class,
//                ['id'=>$this->accountId]
//            )];
    }


    /**
     * @return array
     * @internal
     */
    public function getData() {
        $data = [
            'accountId' => $this->accountId,
            'jobId' => $this->jobId,
        ];

        return $data;
    }

    /**
     * @inject
     * @param Request $request
     * @param JsonResponse $response
     * @internal
     */
    public function handleCreate(Request $request, JsonResponse $response) {
        $jobId = $request->get('jobId', 'int');

        $response->setResponse([$jobId]);
        $response->output();
    }
}
