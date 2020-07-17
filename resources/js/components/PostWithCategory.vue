<template>
    <div>
        <div v-for="post in posts" :key="post.id">
           <div class="col-md-12">
											<div class="blog-entry ftco-animate d-md-flex fadeInUp ftco-animated">
						              		<a href="user.php?id=13" class="img img-2" style="background-image: url('/images/author.jpg');"></a>
										<div class="text text-2 pl-md-4">
							              <h3 class="mb-2"><a href="">{{ post.title }} </a></h3>
							              <div class="meta-wrap">
												<p class="meta">
							              		<span><i class="icon-calendar mr-2"></i>{{ post.created_at }} </span>
							              		<!-- <span><a href="single.html"><i class="icon-folder-o mr-2"></i>Travel</a></span> -->
							              		<span><i class="icon-comment2 mr-2"></i>5 Comment</span>
				              					</p>
			              				</div>
							              <p class="mb-4">{{ post.description }}</p>
							              <p><a href="#" @click="goToPostDetail(post.slug)" class="btn-custom">Đọc tiếp <span class="ion-ios-arrow-forward"></span></a></p>
								            </div>
													</div>
												</div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                message: '',
                error: '' ,
               page:2,
            };
        },

        props : { 
            posts : {
                type : [Object,Array],
            }
        },

        methods:{
            goToPostDetail(slug) {
                window.location.href = "/"+slug
            }, 
        }
    };
</script>