@extends('Back_End.layout.main_desgin')
@section('content')
   <!--start content-->
   <main class="page-content">
       <!--breadcrumb-->
       <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
           <div class="breadcrumb-title pe-3">USERS</div>
           <div class="ps-3">
               <nav aria-label="breadcrumb">
                   <ol class="breadcrumb mb-0 p-0">
                       <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">VIEW USERS</li>
                   </ol>
               </nav>
           </div>
           <div class="ms-auto">
               <div class="btn-group">
                   <a href="{{ route('users.add') }}" class="btn btn-primary">ADD USERS <i
                           class="lni lni-circle-plus"></i></a>
               </div>
           </div>
       </div>
       <!--end breadcrumb-->
       <div class="card">
           <div class="card-body">
               <div class="table-responsive">
                   <table id="example" class="table table-striped table-bordered" style="width:100%">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>user Name</th>
                               <th>Email</th>
                               <th>Role</th>
                               <th>Status</th>
                               <th>Actions</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($users as $user )
                           <tr>
                               <td>
                                   {{ $user->id }}
                               </td>
                               <td>
                                   <div class="d-flex align-items-center gap-3 cursor-pointer">
                                       <div class="">
                                           <p class="mb-0">
                                               {{ $user->name }}
                                           </p>
                                       </div>
                                   </div>
                               </td>
                               <td>
                                {{ $user->email }}
                               </td>
                               <td>
                                {{ $user->role }}
                               </td>
                               <td>@if ($user->active == 1 )
                                   <span class="badge rounded-pill bg-success">ACTIVE</span>
                                   @else
                                   <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                                   @endif
                               </td>
                               <td>
                                @if (Auth::guard('admin')->user()->role == 'supperAdmin')
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{ route('users.edit',$user->id) }}" class="text-warning" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="{{ route('users.delete',$user->id) }}"
                                      class="text-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Delete"><i
                                            class="bi bi-trash-fill"></i></a>
                                </div>
                                @endif
                               </td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </main>
<!--end page main-->
@endsection
