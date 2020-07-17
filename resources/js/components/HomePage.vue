<template>
    <div>
      <form  method="get" >
       <div style="margin-bottom:60px;margin-top:-40px" id="search">
            <input type="text" placeholder="Search...." v-model="search">
            <button type="submit" @click.prevent="searchPost()" class="btn btn-secondary">Search Post</button>
       </div>
    </form>
    <div v-if="error && error.length" class="alert alert-danger">
                    {{error}}
    </div>
        <div v-for="post in posts" :key="post.id">
           <div class="col-md-12">
											<div class="blog-entry ftco-animate d-md-flex fadeInUp ftco-animated" >
						              		<!-- <a href="user.php?id=13" class="img img-2" :style="'background-image: url("storage/upload/"' + post.images+ ')""></a> -->
                                              <img class="img img-2" :src="'storage/upload/' + post.image" alt="">
										<div class="text text-2 pl-md-4">
							              <h3 class="mb-2"><a href="">{{ post.title }} </a></h3>
							              <div class="meta-wrap">
												<p class="meta">
							              		<span><i class="icon-calendar mr-2"></i>{{ post.published_at }} </span>
							              		<!-- <span><a href="single.html"><i class="icon-folder-o mr-2"></i>Travel</a></span> -->
							              		<span><i class="icon-comment2 mr-2"></i>{{ post.cat_count }} Comment</span>
				              					</p>
			              				</div>
							              <p class="mb-4">{{ post.description }}</p>
							              <p><a href="#" @click="goToPostDetail(post.slug)" class="btn-custom">Đọc tiếp <span class="ion-ios-arrow-forward"></span></a></p>
								            </div>
													</div>
												</div>
        </div>
        <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                existPost: true,
                totalPage: '',
                totalPosts: '',
                currentPage: 1,
                search: '',
                status: '',
                error: '' ,
                page:2,
                posts: []
            };
        },

        created() {
            axios.get('/Api/getListPost')
                .then(response =>{ 
                    this.posts = response.data.data
                    })
        },

        methods:{
            goToPostDetail(slug) {
                window.location.href = "/"+slug
            }, 

            searchPost() {
                axios.post('/search/postlist', {search:this.search})
                .then(response => {
                    if (response.data == '') {
                        this.posts = response.data[0]
                        this.error = 'Not Found Any Post With Your Search!'
                        this.existPost = false 
                    } else {
                        this.error = ''
                        this.posts = response.data
                        this.existPost = true
                    }
                });
            },
infiniteHandler($state) {
                let that = this;
 
                this.$http.get('/Api/getListPost?page='+this.page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        $.each(data.data, function(key, value) {
                                that.posts.push(value);
                        });
                        $state.loaded();
                    });
 
                this.page = this.page + 1;
            },
        }
    };
</script>