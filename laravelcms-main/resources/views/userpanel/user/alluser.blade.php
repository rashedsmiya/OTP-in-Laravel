@extends("userpanel.layout.app")

@section('content')

<div class="content-wrapper">
            <!-- Page Title Header Starts-->
            @include('userpanel.layout.pageheader')
            <!-- Page Title Header Ends-->
            <div class="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                
                  <div class="col-12 stretch-card">
                    <div class="card">
                      <div class="card-body">
              
                      @include('userpanel.layout.flash-message') 

                        <h4 class="card-title">User List </h4>
                        <p class="card-description"> Description Here  </p>
                        
                       <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>User  Name</th>
                <th>Email</th>
                <th>Profile Photo</th>
                <th>User type</th>
                <th>Verified</th>
                <th>Created date</th>
                <th>
                    Action 
                </th>
         
            </tr>
        </thead>
        <tbody>

        @foreach($userlist as $key=>$items)
            <tr>
                <td>{{ $items->name}}</td>
                <td>{{ $items->email}}</td>
                <td><img class="img-xs rounded-circle" src="/avatars/{{$items->avatar }}" alt="profile image"></td>
                <td>{{ $items->usertype}}</td>
                <td>{{ $items->email_verified_at}}</td>
                <td>{{ $items->created_at}}</td>
                <td>
                    <a href="http://" target="_blank" rel="noopener noreferrer"> Update</a> || <a href="http://" target="_blank" rel="noopener noreferrer">Delete</a>
                </td>
              
            </tr>

            @endforeach
            
        </tbody>
    </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          
            </div>
</div>
          
        
         
          </div>

@endsection