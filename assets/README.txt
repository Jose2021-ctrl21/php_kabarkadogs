Table bookings {
  id integer [primary key]
  name varchar
  email varchar
  phone_number integer
  date_of_appointment date
  time time
  message varchar
  status_id integer
}

Table statuses {
  id integer [primary key]
  name varchar
}

Table animals {
  id integer [primary key]
  name varchar
  breed varchar
  sex varchar
  weight varchar
  color varchar
  mammal varchar
}

Table donations {
  id integer [primary key]
  donor_name varchar
  contact_number integer
  address varchar
  date_of_donation timestamp
  amount integer

}


Ref: bookings.status_id > statuses.id