<?php

class Record extends Model
{
    public function getContactsByCustomer($customer, $checkboxesValues)
    {
        $customer = $this->db->escape($customer);

        $sql = "SELECT 
                    a.name_customer, 
                    a.company,
                    b.number, 
                    b.date_sign,
                    c.title_service
                FROM obj_customers as a
                    JOIN obj_contacts as b
                        ON b.id_customer = a.id_customer
                    JOIN obj_services as c
                        ON c.id_contact = b.id_contact
                    WHERE (a.id_customer = '{$customer}' OR a.name_customer = '{$customer}')";

        if (count($checkboxesValues) === 1) {
            $checkboxesValues[0] = $this->db->escape($checkboxesValues[0]);
            $sql .= " AND c.status = '{$checkboxesValues[0]}'";
        } elseif (count($checkboxesValues) > 0) {
            for ($i = 0; $i < count($checkboxesValues); $i++) {
                $checkboxesValues[$i] = $this->db->escape($checkboxesValues[$i]);

                if ($i === 0) {
                    $sql .= " AND (c.status = '{$checkboxesValues[$i]}'";
                } elseif ($i === count($checkboxesValues) - 1) {
                    $sql .= " OR c.status = '{$checkboxesValues[$i]}')";
                } else {
                    $sql .= " OR c.status = '{$checkboxesValues[$i]}'";
                }
            }
        }

        return $this->db->query($sql);
    }
}