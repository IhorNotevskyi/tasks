<?php

class RecordsController extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->model = new Record();
    }

    public function index()
    {
    }

    public function search()
    {
        if (!empty($_POST)) {
            header('Content-Type: application/json');

            $customer = $_POST['customer'];
            $checkboxesValues = [];

            if ($_POST['work'] === 'work') {
                $checkboxesValues[] = $_POST['work'];
            }
            if ($_POST['connecting'] === 'connecting') {
                $checkboxesValues[] = $_POST['connecting'];
            }
            if ($_POST['disconnected'] === 'disconnected') {
                $checkboxesValues[] = $_POST['disconnected'];
            }

            $this->checkFormFields($customer, $checkboxesValues);

            $customer = trim(strip_tags($customer));

            if ($this->model->getContactsByCustomer($customer, $checkboxesValues) === []) {
                echo json_encode(['search_error' => 'Такого клиента не существует']); die;
            } else {
                $contacts = $this->model->getContactsByCustomer($customer, $checkboxesValues);
                $groupedContacts = $this->groupContacts($contacts);

                echo json_encode($groupedContacts); die;
            }
        }
    }

    private function checkFormFields($customer, $checkboxesValues)
    {
        $errors = [];

        if ($customer === '') {
            $errors['customer_error'] = 'Данное поле обязательно для заполнения';
        }
        if (mb_strlen($customer) > 250) {
            $errors['customer_error'] = 'Максимальная длина данного поля 255 символов';
        }
        if ($checkboxesValues === []) {
            $errors['status_error'] = 'Вы не выбрали статус договора';
        }

        if ($errors !== []) {
            echo json_encode($errors); die;
        }
    }

    private function groupContacts($contacts)
    {
        $groupedContacts = [];

        foreach ($contacts as $contact) {
            $key = $contact['number'] . ' ' . $contact['date_sign'];

            if (array_key_exists($key, $groupedContacts)) {
                $groupedContacts[$key]['title_service'][] = $contact['title_service'];
            } else {
                $groupedContacts[$key] = $contact;
                $groupedContacts[$key]['title_service'] = [$contact['title_service']];
            }
        }

        return array_values($groupedContacts);
    }
}
