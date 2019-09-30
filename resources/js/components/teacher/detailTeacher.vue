<template>
<div class="container-fluid main-container">
    <vue-headful
                :title="teacherData.name+' | EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn'"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        />
  <section id="info-teacher" class="bottom-slider py-100">
    <div class="container">
      <div class="row media">
        <div class="media-left col-md-4 col-sm-6">
          <div class="avatar">
            <img :src="teacherData.image" alt="">
          </div>
        </div>
        <div class="col-md-4 col-sm-6 mt-20">
          <h4 class="media-heading fs-20 ">{{teacherData.name}}</h4>
          <p class="help-block fs-16"><i class="glyphicon glyphicon-map-marker"></i>{{overView.count}} Review</p>
          <p class="help-block fs-16"><i class="glyphicon glyphicon-envelope"></i>Score: {{overView.avg}} / 5</p>
          <div class="star-rating-container">
              <div :class="'star-rating star-rating-' + overView.star">
                    <div class="star-item star-item--color">
                        <img src="/images/single-star-transparent.svg" alt="Star 1">
                    </div>
                    <div class="star-item star-item--color">
                        <img src="/images/single-star-transparent.svg" alt="Star 2">
                    </div>
                    <div class="star-item star-item--color">
                        <img src="/images/single-star-transparent.svg" alt="Star 3">
                    </div>
                    <div class="star-item star-item--color">
                        <img src="/images/single-star-transparent.svg" alt="Star 4">
                    </div>
                    <div class="star-item star-item--color">
                        <img src="/images/single-star-transparent.svg" alt="Star 5">
                    </div>
                </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 mt-20">
            <div class="review-btn-right">
                <div class="quick-evaluate__user-business quick-evaluate__user-business--logged-out">
                    <img class="quick-evaluate__default-image" :src="[user!=null ? user.avatar : '/images/73x73.png']"  alt="Your profile picture">
                    <h2 class="quick-evaluate__label">
                        Viết đánh giá của bạn
                    </h2>
                </div>
                <div class="quick-evaluate__rating">
                    <div class="quick-evaluate__rating-evaluate">
                        <router-link :to="{name: 'create_review_teacher',params:{ id: teacherData.id },query:{stars:star}}">
                            <div :class="'star-rating star-selector star-rating--large star-rating-'+star">
                                <div class="star-item star-item--color">
                                        <img @mouseover="star=1"
                                            @mouseleave="star=0"
                                            src="/images/single-star-transparent.svg" alt="Star 1">
                                </div>
                                <div class="star-item star-item--color">
                                        <img @mouseover="star=2"
                                            @mouseleave="star=0"
                                            src="/images/single-star-transparent.svg" alt="Star 2">
                                </div>
                                <div class="star-item star-item--color">
                                        <img @mouseover="star=3"
                                            @mouseleave="star=0"
                                            src="/images/single-star-transparent.svg" alt="Star 3">
                                </div>
                                <div class="star-item star-item--color">
                                        <img @mouseover="star=4"
                                            @mouseleave="star=0"
                                            src="/images/single-star-transparent.svg" alt="Star 4">
                                </div>
                                <div class="star-item star-item--color">
                                        <img @mouseover="star=5"
                                            @mouseleave="star=0"
                                            src="/images/single-star-transparent.svg" alt="Star 5">
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>

  <section id="body-teacher">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3 class="title-company-w fs-20">Đánh giá giáo viên</h3>
        </div>
        <div class="review-list col-md-12 col-lg-8">
            <template v-if="load">
                <vcl-facebook/>
            </template>
            <template v-else>
                <ReviewTeacher  v-for="review in reviewsTeacher"
                                :review="review"
                                :key="review.id"
                                @update-review="updateReview">
                </ReviewTeacher>
            </template>
        </div>
        <div class="col-lg-4">
            <div class="info-teacher">
                <div class="card card--related">
                    <div class="card-left">
                        <h3 class="title-company-w fs-20">Thông tin</h3>
                        <p>Giới tính: {{teacherData.gender?'Male':'Female'}}</p>
                        <p>Sinh nhật: {{teacherData.birthday}}</p>
                        <p>Địa chỉ: {{teacherData.address}}</p>
                        <p>Số điện thoại: {{teacherData.phone}}</p>
                        <p>Chuyên môn: {{teacherData.specialize}}</p>
                        <p>Email: {{teacherData.email}}</p>
                    </div>
                </div>
                <div class="card card--related">
                    <div class="card-left">
                        <h3 class="title-company-w fs-20">Giới thiệu</h3>
                        <p>{{teacherData.description}}</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
  <section id="img-teacher" class="pt-20 pb-10">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3 class="title-company-w fs-20">Ảnh giáo viên</h3>
        </div>
        <div v-for="image in teacherData.media" :key="image.id" class="mb-20 col-md-4">
            <a class="fancybox-thumb img-company" rel="fancybox-thumb" :href="image+'.jpg'">
                <img :src="image">
            </a>
        </div>
      </div>
    </div>
  </section>
</div>
</template>
<script>
import { get } from "../../helpers/api"
import {mapState,mapGetters} from 'vuex'
import { detailTeacher } from '../../router/router'
import { VclFacebook } from 'vue-content-loading'
import ReviewTeacher from '../review/layoutReviewDetailOfTeacher'
    export default{
        name: 'app-detail-teacher',
        components: {
            ReviewTeacher,
            VclFacebook
        },
        computed: {
           ...mapGetters('auth',['user']),
        },
         data() {
            return {
                reviewsTeacher: [],
                teacherData:[],
                overView:[],
                star: 0,
                load:true
            }
        },
        mounted() {
            get(detailTeacher+this.$route.params.id)
            .then((res)=>{
                this.teacherData = res.data.detail_teachers.teacher
            })
            .catch((err)=>{
                if (err.response.data.http_status.code == 404 ||
                        err.response.data.http_status.code == 401) {
                        this.$router.replace('/not-found')
                    }
            })

            $(document).ready(function() {
                $(".fancybox-thumb").fancybox({
                    prevEffect	: 'none',
                    nextEffect	: 'none',
                    helpers	: {
                        title	: {
                            type: 'outside'
                        },
                        thumbs	: {
                            width	: 50,
                            height	: 50
                        }
                    }
                });
            });
            get('teacher/'+this.$route.params.id+'/review')
            .then((res)=>{
                this.reviewsTeacher = res.data.review_teachers.review.data
                this.load = false
            })
            get('teacher/'+this.$route.params.id+'/over-view')
            .then((res)=>{
                this.overView = res.data.over_view
                // console.log(this.overView)
            })
        },
        methods: {
            updateReview(){
                get('teacher/'+this.$route.params.id+'/review')
                .then((res)=>{
                    this.reviewsTeacher = res.data.review_teachers.review.data
                })
            }
        }
    }
</script>
<style lang="scss" scoped>

.pt-25 {
    padding-top: 25px;
}
.card-left {
    padding: 15px;
}
.fs-20 {
    font-size: 21px;
    color: #000;
    text-align: left;
    margin-bottom:25px;
}

.fs-16 {
    font-size: 15px;
}
.mt-20>.star-rating-container{
    width:220px;
}
.media-heading {
    margin-top: 10px;
    margin-bottom: 8px;
}

.avatar>img {
    max-width: 250px;
        max-height: 250px;

}
@media(max-width: 991px){
    .avatar>img {
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
    display:block;
    }
}
#info-teacher{
    margin-top:100px
}
.mb-20,#info-teacher {
    margin-bottom: 20px;
}

#img-teacher {
    margin-top:30px;
    background-color: #fff;
}

.py-130 {
    padding-top: 130px;
    padding-bottom: 130px;
}

.px-30 {
    padding-left: 30px;
    padding-right: 30px;
}

.pt-20 {
    padding-top: 20px
}

.pb-10 {
    padding-bottom: 10px
}

.img-company>img {
    max-width: 100%;
    height: 250px;
}

#images-company {
    border-bottom: 1px solid #eaeaea;
}

::-webkit-input-placeholder {
    color: #FFF;
}

:-moz-placeholder {
    /* Firefox 18- */
    color: #FFF;
}

::-moz-placeholder {
    /* Firefox 19+ */
    color: #FFF;
}

:-ms-input-placeholder {
    color: #FFF;
}

@media (min-width: 770px) and (max-width: 1200px) {
    .bottom-slider {
        .info-block {
            p {
                font-size: 18px;
            }
            h3 {
                font-size: 28px;
                margin: 0 0 2px;
                color: #fff;
            }
        }
    }

}

@media (min-width: 481px) and (max-width: 769px) {
    .bottom-slider {
        .info-block {
            p {
                font-size: 15px;
            }
            h3 {
                font-size: 20px;
                margin: 0 0 2px;
                color: #fff;
            }
        }
    }

}

@media (min-width: 320px) and (max-width: 480px) {
    .bottom-slider {
        .info-block {
            p {
                font-size: 15px;
            }
            h3 {
                font-size: 20px;
                margin: 0 0 2px;
                color: #fff;
            }
        }
    }
}
.quick-evaluate__user-business{display:flex;word-break:break-all;align-items:center}
.quick-evaluate__user-business--logged-in{display:none;}
.quick-evaluate--logged-in .quick-evaluate__user-business--logged-in{display:flex}
.quick-evaluate--logged-in .quick-evaluate__user-business--logged-out{display:none}
.quick-evaluate__name-label-wrapper{flex-direction:row;margin-left:16px}
.quick-evaluate__default-image,.quick-evaluate__profile-image{position:relative;width:40px;height:40px;border-radius:50%}
.quick-evaluate__default-image{margin-right:10px}
.quick-evaluate__profile-image{border-radius:50%;height:40px;background-color:#fff}
.quick-evaluate__profile-name{font-weight:700}
.quick-evaluate__label,.quick-evaluate__profile-name{font-size:16px;font-size:1rem;line-height:20px;line-height:1.25rem}
.quick-evaluate__label{display:block;color:#73738f;margin:0;word-break:break-word;font-weight:400}
.quick-evaluate__rating{flex-grow:1}
.quick-evaluate__rating-evaluate{display:flex;flex-direction:row;justify-content:flex-end;flex-wrap:wrap;margin:0}
.review-btn-right{
    width: 260px;
    border: 1px solid;
    padding: 20px;
    margin-top:20px;
    margin-left: auto;
    margin-right: auto;
}
.quick-evaluate__rating{
    margin-top:10px;
}
@media only screen and (min-width:640px){
    .star-rating-container{width:175px;height:35px}
}
@media only screen and (min-width:640px) and (min-height:640px) and (min-width:768px){.star-rating-container{width:78px;height:15px}}
@media only screen and (min-width:1024px){.star-rating-container{width:212px;height:40px}}
@media(max-width:768px){
    .review-btn-right{
        margin-top: 30px;
        margin-bottom: 30px;
    }
}
.review-list{
    margin-bottom:25px;

}
</style>
