@extends('Back_End.layout.main_desgin')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">airportS</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">VIEW airportS</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('airports.add') }}" class="btn btn-primary">ADD airport <i
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
                            <th>airports Code</th>
                            <th>airports name</th>
                            <th>airports City Code</th>
                            <th>airports City Name</th>
                            <th>airports Country Code</th>
                            <th>airports Country Name</th>
                            <th>Timezone</th>
                            <th>Late</th>
                            <th>Long</th>
                            <th>Num Airports</th>
                            <th>city</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airports as $airport )
                        <tr>
                            <td>
                                {{ $airport->id }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <div class="">
                                        <p class="mb-0">
                                            {{ $airport->code }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $airport->name }}
                            </td>
                            <td>
                                {{ $airport->cityCode }}
                            </td>
                            <td>
                                {{ $airport->cityName }}
                            </td>
                            <td>
                                {{ $airport->countryName }}
                            </td>
                            <td>
                                {{ $airport->countryCode }}
                            </td>
                            <td>
                                {{ $airport->timezone }}
                            </td>
                            <td>
                                {{ $airport->lat }}
                            </td>
                            <td>
                                {{ $airport->lon }}
                            </td>
                            <td>
                                {{ $airport->numAirports }}
                            </td>
                            <td>
                                {{ $airport->city }}
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
