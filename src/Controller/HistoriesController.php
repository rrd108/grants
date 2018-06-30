<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * Histories Controller
 *
 * @property \App\Model\Table\HistoriesTable $Histories
 *
 * @method \App\Model\Entity\History[] paginate($object = null, array $settings = [])
 */
class HistoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CompaniesGrants.Grants', 'CompaniesGrants.Companies', 'Statuses', 'Users']
        ];
        $histories = $this->paginate($this->Histories);

        $this->set(compact('histories'));
        $this->set('_serialize', ['histories']);
    }

    /**
     * View method
     *
     * @param string|null $id History id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $history = $this->Histories->get($id, [
            'contain' => ['CompaniesGrants', 'Statuses', 'Users']
        ]);

        $this->set('history', $history);
        $this->set('_serialize', ['history']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $history = $this->Histories->newEntity();
        if ($this->request->is('post')) {
            $history = $this->Histories->patchEntity($history, $this->request->getData());
            if ($history->deadline == null) {
                $history->hasdeadline = null;
            }
            if ($this->Histories->save($history)) {
                $this->Flash->success(__('The history has been saved.'));

                return $this->redirect('/');
            }
            $this->Flash->error(__('The history could not be saved. Please, try again.'));
        }

        $companiesGrants = $this->Histories->CompaniesGrants->find()
            ->contain(['Companies', 'Grants'])
            ->indexBy('id')
            ->map(function ($companyGrant) {
                return $companyGrant->company->name . ' - ' . $companyGrant->grant->shortname;
            });
        $statuses = $this->Histories->Statuses->find('list', ['limit' => 200])->order('name');
        $users = $this->Histories->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'username',
            'limit' => 200
        ]);
        if(AppController::timeZone == 'Europe/Paris'){
            $time = Time::now()->modify('+1 hours');
        } else {
            $time =  Time::now();
        }
        $time = date('Y-m-d H:i:s',$time->timestamp);
        $deadlinetime = Time::now()->addDay(8);
        $deadlinetime = date('Y-m-d',$deadlinetime->timestamp);
        $this->set('time',$time);
        $this->set('deadlinetime',$deadlinetime);
        $this->set(compact('history', 'companiesGrants', 'statuses', 'users'));
        $this->set('_serialize', ['history']);
    }

    /**
     * Edit method
     *
     * @param string|null $id History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $history = $this->Histories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $history = $this->Histories->patchEntity($history, $this->request->getData());
            if ($history->hasdeadline != 1) {
                $history->deadline = null;
            }
            if ($this->Histories->save($history)) {
                $this->Flash->success(__('The history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The history could not be saved. Please, try again.'));
        }
        $companiesGrants = $this->Histories->CompaniesGrants->find('list', ['limit' => 200]);
        $statuses = $this->Histories->Statuses->find('list', ['limit' => 200]);
        $users = $this->Histories->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'username',
            'limit' => 200
        ]);
        $this->set(compact('history', 'companiesGrants', 'statuses', 'users'));
        $this->set('_serialize', ['history']);
    }

    /**
     * Delete method
     *
     * @param string|null $id History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $history = $this->Histories->get($id);
        if ($this->Histories->delete($history)) {
            $this->Flash->success(__('The history has been deleted.'));
        } else {
            $this->Flash->error(__('The history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Set a history event as done by the current user
     *
     * @param string|null $id History id.
     * @return null
     */
    public function setDone($id = null) {
        if ($this->request->is('ajax')) {
            $history = $this->Histories->get($id);
            $history->doneby = $this->Auth->user('id');
            $history = $this->Histories->patchEntity($history, $this->request->getData());
            $saved = false;
            if ($this->Histories->save($history)) {
                $saved = true;
            }
            $this->set(compact('saved'));
            $this->set('_serialize', ['saved']);
        }
    }

    /**
     * Show history events what are not done yet
     *
     * @return \Cake\Http\Response|void
     */
    public function showInProgress() {
        $this->paginate = [
            'contain' => ['CompaniesGrants.Grants', 'CompaniesGrants.Companies', 'Statuses', 'Users'],
            //'order' => ['Histories.deadline' => 'ASC']
        ];

        $histories = $this->paginate($this->Histories->find('inProgress'));

        $this->set(compact('histories'));
        $this->set('_serialize', ['histories']);
    }
}
