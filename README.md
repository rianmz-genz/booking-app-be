#stadium_category entity:

-   name
-   logo

#stadium entity:

-   address
-   name
-   phone
-   description
-   multiple_images
-   open_at (hour)
-   closed_at (hour)
-   stadium_category_id

#field entity:

-   name
-   size
-   description
-   price
-   type_price
-   multiple_images
-   stadium_id

#field_facility:

-   field_id
-   facility_id

#stadium_facilty:

-   stadium_id
-   facility_id

#facility entity:

-   name
-   logo

#ticket entity:

-   fullname
-   phone
-   email
-   field_id
-   date
-   start_hour
-   end_our
-   payment_status (booking, paid)
-   user_id

#user entity:

-   fullname
-   email
-   phone
-   password
-   role [admin, customer, super_admin]
-   is_active
