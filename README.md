
### Installation and Configuration

** Install Deemples Task from your console.**

##### Execute these commands below, in order

1. Create a database and set its name in your .env file under (DB_DATABASE)

2. In your terminal run these commands
~~~
 composer install
~~~

~~~
php artisan migrate
~~~

~~~
php artisan db:seed
~~~

~~~
php artisan key:generate
~~~

~~~
php artisan vendor:publish
~~~

~~~
Type 0 then press enter
~~~

~~~
php artisan optimize
~~~

~~~
php artisan serve
~~~

**Explanation to how the signature work**

1. I had two ideas to sync records and update it , one was to loop over each and every field and compare it to the existing records in the database which I thought to be efficient but nonscalable one , because it will need extra checks with any extra field added to the shop model and that means extra (if conditions) which leads to breaking one of the SOLID principles (Open for extension Closed for modification) .

2. The other idea which I implemented was to make a hash function to hash all the fields and save it in the database , compare the hash with the incoming record after hashing its values , if the hash matches so no need to check over all the values from the incoming record, else we update the record with the new data.

3. Hash functions are used to validate integrity in technologies (ex: Blockchains) and websites (ex: Github)


**Assumptions , Validations ,and Instructions**

1. There must be a unique identifier and I assumed it to be the ID.
2. The uploaded file must be in the (.xslx) format (ex: excel sheet).
3. If you want to add a new record add a unique numeric id with your data.
4. Don't leave any empty cell in the file.
5. If you want to delete a row , don't leave its place empty , in other words , choose (delete entire row) option which is provided in any excel reader.
6. any change in the ID field will create a new record deleting the old one.
