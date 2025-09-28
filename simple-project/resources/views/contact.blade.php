@extends('layouts.master')

@section('content')
 <div class="container-fluid px-4">
    <h1 class="mt-4">Contact Us</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Contact Us</li>
    </ol>
    <div class="row justify-content-center">
         <div class="col-md-6">
             <div class="card">
                <div class="card-header">
                    <h4>Contact Us</h4>
                </div>
             </div>
             <div class="card-body">
                 <form>
                     <label> Name </label>
                     <input type="text" class="form-control" placeholder="Enter Your Name">
                 </form>
             </div>
         </div>
    </div>                         
</div>
@endsection

