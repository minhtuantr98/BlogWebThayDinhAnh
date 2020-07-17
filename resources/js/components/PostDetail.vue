<template>
    <div style="width:600px;height:auto">
        <p>{{ post.published_at }}</p>
			<h1 class="mb-3">{{ post.title }}</h1>
            <p>{{ post.description }}</p> 
            <p v-html="post.content"></p>
            <div class="tag-widget post-tag-container mb-5 mt-5">
		              <div class="tagcloud">
		                <a href="#" class="tag-cloud-link">Văn hóa</a>
		                <a href="#" class="tag-cloud-link">Ẩm thực</a>
		                <a href="#" class="tag-cloud-link">Con người</a>
		                <a href="#" class="tag-cloud-link">Thiên nhiên</a>
		              </div>
		    </div>
             <div class="block-1">
		              <div class="block-2">
		                <a href="#">	                	
			                	<img :src="'storage/upload/'+user.image" alt="" class="img-fluid mb-4">	
						</a>
		              </div>
		              <div class="block-3">
		                <h3>Author:  {{ user.name }}</h3>
		                <p>{{ user.description }}</p>
		              </div>
		    </div>
             <div class="comment-form-wrap pt-5">
		                <h3 class="mb-5">Để lại lời bình luận</h3>
		                <form method="get" enctype="multipart/form-data" class="p-3 p-md-5 bg-light">
		                  <div class="form-group">
		                    <label for="message">Bình luận</label>
		                    <textarea v-model="content" id="message"  class="form-control"></textarea>
		                  </div>
		                  <div class="form-group">
		                    <input type="submit" @click.prevent="addComment(post.id)" value="Đăng bình luận" class="btn py-3 px-4 btn-primary">
		                  </div>
		                </form>
		              </div>
                  <h3 class="mb-5 font-weight-bold">{{ this.totalComment }} Bình luận</h3>
             <div class="pt-5 mt-5" style="height:500px;overflow:auto" >
		              <ul class="comment-list">
                        <div id="deleteComment" v-for="comment in comments" :key="comment.id">
		                <li class="comment">
                      <a style="float:right;margin-right:20px" @click="deleteComment(comment.id, post.id)">x</a>
		                  <div class="vcard bio">
		                    <img :src="'storage/upload/'+comment.image" alt="Image placeholder">
		                  </div>
		                  <div class="comment-body">
		                    <h3 v-if="comment.is_admin == 1">{{ comment.name}} <span style="color:red">(Admin)</span> </h3>
                        <h3 v-else>{{ comment.name}}</h3>
		                    <div class="meta">{{ comment.created_at }}</div>
		                    <p>{{ comment.content }}</p>
		                  </div>
		                </li>
                        </div>
		              </ul>
		              <!-- END comment-list -->
		          </div>
	</div>
</template>

<script>
    export default {
        data: function() {
            return {
                message: '',
                error: '' ,
                 content: '',
                 comments: [],
                 id: '',
                 totalComment: '',
                 user: [],
                 
            };
        },

        props : { 
            post : {
                type : Object,
            },
        },

        created() {
           this.user = this.$attrs['user'];
            this.comments = this.$attrs['comments'];
            this.totalComment = this.$attrs['totalcomment'];
        },

         methods:{
           deleteComment(idComment, idPost) {
                axios.post('/post/deleteComment', {idComment:idComment, idPost:idPost})
                .then(response => {
                    if (response.data == 1) {
                        alert("You dont have permission to do this");
                    } else {
                        this.comments = response.data
                    }
                });
                axios.post('/post/countComment', {id:idPost})
                .then(response => {
                    if (response.data == '') {
                        this.totalComment = response.data
                    } else {
                        this.totalComment = response.data
                    }
                });
            },
         addComment(id) {
                axios.post('/post/addComment', {content:this.content,id:id})
                .then(response => {
                    if (response.data == 1) {
                        alert("You must login to comment");
                    } else {
                        this.comments = response.data
                        this.content = "";
                    }
                });
                axios.post('/post/countComment', {id:id})
                .then(response => {
                    if (response.data == '') {
                        this.totalComment = response.data
                    } else {
                        this.totalComment = response.data
                    }
                });
            },
         }
    };
</script>