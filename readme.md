## Setup Instructions

1. Clone the repository from GitHub:
   git clone https://github.com/your_username/neuromodulation.git
   cd neuromodulation

2. Create the database and tables:

   - Open the `Database/create_tables.sql` file and run the script in MSSQL Server.
   - Open the `Database/insert_stored_procedures.sql` file and run the script in MSSQL Server.

3. Configure the database connection:

   - create sql user and create password
   - Edit and update the above sql credentials in config.php

4. Set up IIS to point to the `public` directory.

5. Access the application:
   - Open `http://localhost/index.php` to access the form.
   - Open `http://localhost/admin.php` to access the admin view.
