@extends('Back_End.layout.main_desgin')
@section('content')
   <!--start content-->
   <main class="page-content">
       <!--breadcrumb-->
       <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
           <div class="breadcrumb-title pe-3">REVIEWS</div>
           <div class="ps-3">
               <nav aria-label="breadcrumb">
                   <ol class="breadcrumb mb-0 p-0">
                       <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">VIEW REVIEWS</li>
                   </ol>
               </nav>
           </div>
       </div>
       <!--end breadcrumb-->
       <div class="card">
           <div class="card-body">
               <div class="table-responsive" style="white-space:normal !important">
                   <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>User Id</th>
                            <th>Hotel Id</th>
                            <th>Package Id</th>
                            <th>Reviewer Name</th>
                            <th>Reviewer Email</th>
                            <th>Review Stars</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review )
                        <tr>
                            <td>
                                {{ $review->id }}
                            </td>
                            <td>
                                {{ $review->user_id }}
                            </td>
                            <td>
                                {{ $review->hotel_id }}
                            </td>
                            <td>
                                {{ $review->package_id }}
                            </td>
                            <td>
                                {{ $review->review_name }}
                            </td>
                            <td>
                                {{ $review->review_email }}
                            </td>
                            <td>
                            @switch($review->star_review)
                                @case(5)
                                    <span class="badge rounded-pill bg-success">({{ $review->star_review }}) Excellent</span>
                                    @break
                                @case(4)
                                    <span class="badge rounded-pill bg-success">({{ $review->star_review }}) Very Good</span>
                                    @break
                                @case(3)
                                    <span class="badge rounded-pill bg-warning">({{ $review->star_review }}) Good</span>
                                    @break
                                @case(2)
                                    <span class="badge rounded-pill bg-danger">({{ $review->star_review }}) Not Good</span>
                                    @break
                                @case(1)
                                    <span class="badge rounded-pill bg-danger">({{ $review->star_review }}) Poor</span>
                                    @break
                            @endswitch
                            </td>
                            <td style="word-wrap: break-word;overflow-wrap: break-word">
                                {{ $review->message }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                   </table>
               </div>
           </div>
       </div>
   </main>
@endsection
