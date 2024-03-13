@extends('layouts.admin.master')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-4">
      <!-- Ratings -->
      <div class="col-xl-3 col-sm-6 mt-5">
        <div class="card">
          <div class="row">
            <div class="col-6">
              <div class="card-body">
                <div class="card-info">
                  <h6 class="mb-4 pb-1 text-nowrap">Total Students</h6>
                  <div class="d-flex align-items-end mb-3">
                    <h4 class="mb-0 me-2">{{ $student }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mt-5">
        <div class="card">
          <div class="row">
            <div class="col-6">
              <div class="card-body">
                <div class="card-info">
                  <h6 class="mb-4 pb-1 text-nowrap">Total Teachers</h6>
                  <div class="d-flex align-items-end mb-3">
                    <h4 class="mb-0 me-2">{{$teacher}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <div class="col-xl-3 col-sm-6 mt-5">
        <div class="card">
          <div class="row">
            <div class="col-6">
              <div class="card-body">
                <div class="card-info">
                  <h6 class="mb-4 pb-1 text-nowrap">Total Users</h6>
                  <div class="d-flex align-items-end mb-3">
                    <h4 class="mb-0 me-2">{{$user}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mt-5">
        <div class="card">
          <div class="row">
            <div class="col-6">
              <div class="card-body">
                <div class="card-info">
                  <h6 class="mb-4 pb-1 text-nowrap">Total Courses</h6>
                  <div class="d-flex align-items-end mb-3">
                    <h4 class="mb-0 me-2">{{$course}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mt-5">
        <div class="card">
          <div class="row">
            <div class="col-6">
              <div class="card-body">
                <div class="card-info">
                  <h6 class="mb-4 pb-1 text-nowrap">Students Questionnaire</h6>
                  <div class="d-flex align-items-end mb-3">
                    <h4 class="mb-0 me-2">{{$sques}}</h4>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mt-5">
        <div class="card">
          <div class="row">
            <div class="col-6">
              <div class="card-body">
                <div class="card-info">
                  <h6 class="mb-4 pb-1 text-nowrap">Teacher Questionnaire</h6>
                  <div class="d-flex align-items-end mb-3">
                    <h4 class="mb-0 me-2">{{$tques}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mt-5">
        <div class="card">
          <div class="row">
            <div class="col-6">
              <div class="card-body">
                <div class="card-info">
                  <h6 class="mb-4 pb-1 text-nowrap">Total ZipCode</h6>
                  <div class="d-flex align-items-end mb-3">
                    <h4 class="mb-0 me-2">{{$zip}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mt-5">
        <div class="card">
          <div class="row">
            <div class="col-6">
              <div class="card-body">
                <div class="card-info">
                  <h6 class="mb-4 pb-1 text-nowrap">Total States</h6>
                  <div class="d-flex align-items-end mb-3">
                    <h4 class="mb-0 me-2">{{$states}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mt-5">
        <div class="card">
          <div class="row">
            <div class="col-6">
              <div class="card-body">
                <div class="card-info">
                  <h6 class="mb-4 pb-1 text-nowrap">Total City</h6>
                  <div class="d-flex align-items-end mb-3">
                    <h4 class="mb-0 me-2">{{$city}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mt-5">
        <div class="card">
          <div class="row">
            <div class="col-6">
              <div class="card-body">
                <div class="card-info">
                  <h6 class="mb-4 pb-1 text-nowrap">Total TimeZone</h6>
                  <div class="d-flex align-items-end mb-3">
                    <h4 class="mb-0 me-2">{{$timezone}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Ratings -->
      <!-- Sessions -->
      </div>
    </div>
@endsection
