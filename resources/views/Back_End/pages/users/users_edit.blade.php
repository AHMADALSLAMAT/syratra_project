@extends('Back_End.layout.main_desgin')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">EDIT USER</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">EDIT USER</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <form action="{{ route('users.update_users',$user->id) }}" method="post" enctype="multipart/form-data"
                    id="userssadd">
                    @csrf
                    <div class="card-header py-3 bg-transparent">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="mb-2 mb-sm-0">Edit USER</h5>
                            <div class="ms-auto">
                                <button type="submit" class="btn btn-primary">Upldated Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-lg-8">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">User name</label>
                                                <input type="text" class="form-control" name="username"
                                                    placeholder="Product title" value="{{ $user->name }}" >
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">User Email</label>
                                                <input type="email" name="user_email" class="form-control"
                                                    placeholder="User Name " value="{{ $user->email }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="User Password">
                                                    <small> if you do not want to change the password keep it empty</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status" required>
                                                    <option @if ($user->active == 1) selected @endif value="1">Published</option>
                                                    <option @if ($user->active == 0) selected @endif value="0">Draft</option>
                                                </select>
                                            </div>

                                                @if (Auth::guard('admin')->user()->role == 'supperAdmin')
                                                <div class="col-12">
                                                    <label class="form-label">User Type</label>
                                                    <select class="form-select" name="role" required>
                                                        <option @if ($user->role == 'superAdmin') selected @endif value="superAdmin">Super Admin</option>
                                                        <option  @if ($user->role == 'Admin') selected @endif  value="Admin">Admin</option>
                                                        <option  @if ($user->role == 'Editor') selected @endif  value="Editor">Editor</option>
                                                    </select>
                                                </div>
                                                @elseif (Auth::guard('admin')->user()->role == 'Admin')
                                                <div class="col-12">
                                                    <label class="form-label">User Type</label>
                                                    <select class="form-select" name="role" required>
                                                        <option  @if ($user->role == 'Editor') selected @endif  value="Editor">Editor</option>
                                                    </select>
                                                </div>
                                                @endif

                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
            </div>

        </form>

        </div>
    </div>
    <!--end row-->

</main>
@endsection

