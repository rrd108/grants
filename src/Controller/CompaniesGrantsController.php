<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * CompaniesGrants Controller
 *
 * @property \App\Model\Table\CompaniesGrantsTable $CompaniesGrants
 *
 * @method \App\Model\Entity\CompaniesGrant[] paginate($object = null, array $settings = [])
 */
class CompaniesGrantsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     * @param $nonFinished show only non finished grants
     */
    public function index(int $nonFinished = 1)
    {
        $finishedStatus = 4;    //TODO hardcoded
        $this->paginate = [
            'sortWhitelist' => [
                'Companies.name',
                'Grants.shortname',
                'amount',
                'contact',
                'LatestHistory.Histories__deadline',
                'Statuses.name'
            ],
            'order' => [
                'LatestHistory.Histories__deadline' => 'DESC',
                'Statuses.await' => 'DESC',
                'Statuses.name'
            ]
        ];

        $condition = ['Statuses.id' => $finishedStatus];
        if ($nonFinished) {
            $condition = ['Statuses.id !=' => $finishedStatus];
        }

        $companiesGrants = $this->paginate(
            $this->CompaniesGrants->find('current')
                ->where($condition)
        );
        $this->set(compact('companiesGrants', 'nonFinished'));
        $this->set('_serialize', ['companiesGrants']);
    }

    /**
     * View method
     *
     * @param string|null $id Companies Grant id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $companiesGrant = $this->CompaniesGrants->get($id, [
            'contain' => [
                'Companies',
                'Grants.Issuers',
                'Histories' => ['Statuses', 'Users', 'DonebyUsers']
            ]
        ]);

        $statuses = $this->CompaniesGrants->Histories->Statuses->find('list')->order('name')->all();
        $users = $this->CompaniesGrants->Histories->Users->find('list',
            ['keyField' => 'id', 'valueField' => 'username'])->all();
        if(AppController::timeZone == 'Europe/Paris'){
            $time = Time::now()->modify('+1 hours');
        } else {
            $time =  Time::now();
        }
        $time = date('Y-m-d H:i:s',$time->timestamp);
        $deadlineTime = Time::now()->addDay(8);
        $deadlineTime = date('Y:m:d',$deadlineTime->timestamp);
        $this->set('users', $users);
        $this->set('statuses', $statuses);
        $this->set('time',$time);
        $this->set('deadlineTime', $deadlineTime);
        $this->set('companiesGrant', $companiesGrant);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $companiesGrant = $this->CompaniesGrants->newEntity();
        if ($this->request->is('post')) {
            $companiesGrant = $this->CompaniesGrants->patchEntity($companiesGrant, $this->request->getData());
            if ($this->CompaniesGrants->save($companiesGrant)) {
                $this->Flash->success(__('The companies grant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The companies grant could not be saved. Please, try again.'));
        }
        $companies = $this->CompaniesGrants->Companies->find('list', ['limit' => 200]);
        $grants = $this->CompaniesGrants->Grants->find('list', ['limit' => 200]);
        $this->set(compact('companiesGrant', 'companies', 'grants'));
        $this->set('_serialize', ['companiesGrant']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Companies Grant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $companiesGrant = $this->CompaniesGrants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $companiesGrant = $this->CompaniesGrants->patchEntity($companiesGrant, $this->request->getData());
            if ($this->CompaniesGrants->save($companiesGrant)) {
                $this->Flash->success(__('The companies grant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The companies grant could not be saved. Please, try again.'));
        }
        $companies = $this->CompaniesGrants->Companies->find('list', ['limit' => 200]);
        $grants = $this->CompaniesGrants->Grants->find('list', ['limit' => 200]);
        $this->set(compact('companiesGrant', 'companies', 'grants'));
        $this->set('_serialize', ['companiesGrant']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Companies Grant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $companiesGrant = $this->CompaniesGrants->get($id);
        if ($this->CompaniesGrants->delete($companiesGrant)) {
            $this->Flash->success(__('The companies grant has been deleted.'));
        } else {
            $this->Flash->error(__('The companies grant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
