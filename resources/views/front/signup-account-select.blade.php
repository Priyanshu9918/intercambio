@extends('layouts.front.master')
@section('content')
<main>
    <!-- sign in area start -->
    <section class="bg-white pt-60 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-area-8 text-center mb-30">
                        <h2 class="section-title mb-0">Choose Account Type</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <a class="" href="{{route('front.student-signup')}}">
                        <div class="h8_career-item mb-30">
                            <div class="h8_career-item-img">
                                <img src="{{ asset('front/assets/img/student-icon.png')}}" style="max-width: 170px;" alt="">
                            </div>
                            <div class="h8_career-item-content">
                                <h3 class="mb-2">Student</h3>
                                <p class="mb-0 ">Create a student account to start learning</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <a class="" href="{{route('teacher.teacher-signup')}}">
                        <div class="h8_career-item mb-30">
                            <div class="h8_career-item-img">
                                <img src="{{ asset('front/assets/img/teacher-icon.png')}}" style="max-width: 170px;" alt="">
                            </div>
                            <div class="h8_career-item-content">
                            <h3 class="mb-2">Teacher</h3>
                                <p class="mb-0 ">Create a teacher account to start teaching</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
        @endsection
        @push('script')
    <script>

    </script>
    @endpush
