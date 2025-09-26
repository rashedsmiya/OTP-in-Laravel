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

                        <h4 class="card-title">Horizontal Form</h4>
                        <p class="card-description"> Horizontal form layout </p>
                        
                        <form action="{{route('profileupdate')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">User Name </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id ="name" name="name" value="{{Auth::user()->name}}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">User Email </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id ="email" value="{{Auth::user()->email}}" name="email">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">User Email </label>
                            <div class="col-sm-9">
                            <img src="/avatars/{{ Auth::user()->avatar }}" style="width:80px;margin-top: 10px;">
                            
                            <input type="file" class="form-control"  name="avatar">
                            </div>
                          </div>

                          <button type="submit" class="btn btn-success mr-2">Udate</button>
                          <button class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          
            </div>
</div>
          
        
         
          </div>

@endsection