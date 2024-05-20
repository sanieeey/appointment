<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
   // Define the table associated with the model
   protected $table = 'clients';

   // Define fillable attributes
   protected $fillable = [
      'firstname',
      'lastname', 
      'middlename', 
      'birthdate', 
      'address', 
      'email', 
      'phone_number', 
      'reason',
      'status'
   ];
}
