@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 class="mb-2 mt-4">Small Box</h5>
                    <div class="row">
                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3>{{ $comment }}</h3>
            
                            <p>New Comment</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-comments"></i>
                          </div>
                          <a href="/admin/comment" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                          <div class="inner">
                          <h3>{{ $category }}</h3>
            
                            <p>Topic</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="/admin/category" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3>{{ $user }}</h3>
            
                            <p>User Registrations</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-user-plus"></i>
                          </div>
                          <a href="/admin/user" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                          <div class="inner">
                          <h3>{{ $post }}</h3>
            
                            <p>Post news</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                          </div>
                          <a href="/admin/post" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>
                      <!-- ./col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
