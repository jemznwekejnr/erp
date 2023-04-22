<x-layout>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Category</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item">
                                    <a href="/categories"><i class="bx bx-copy"></i></a>
                                    
								</li>
								<li class="breadcrumb-item active" aria-current="page"> {{$category->name}} </li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
    


          <div class="row">
              
             
         </div>


       <div class="card-body" style="padding-top: 40px;">
				  	<div class="form-body">
					 <form class="row g-3" action="/category/{{$category->id}} " id="submitstaff" method="post">
					 	@csrf
                        @method('PUT')
					 	<div class="col-sm-4">
					 	
					 	</div>
					 	<div class="col-sm-8">
					 	<div class="row">
						 	<div class="col-sm-6">
								<label for="name" class="form-label">( Edit )  Category Name<small style="color:#ff0000">*</small></label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Stock  Name"  value="{{$category->name}}"  required>
                                 @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
							</div>
						 	<div class="col-sm-6">
								
							</div>
						</div>
                        <br/>
						
                     
						<div class="row">
						 	<div class="col-sm-6">
								<button class="btn btn-info" type="submit" id="button">Submit</button>
							</div>
						 	
						</div><br />
						</div>
					 </form>
					 </div>
				  </div>
		
	</div>
</div>
<!--end page wrapper -->
				



</x-layout>