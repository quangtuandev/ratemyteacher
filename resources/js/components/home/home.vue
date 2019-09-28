<template>
<div id="home">
     <vue-headful
                title="EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        />
        <section class="hero">
            <div class="hero-container">
                <h1 class="hero-title">
                    Đằng sau mỗi đánh giá là một kinh nghiệm quan trọng
                </h1>
                <h2 class="hero-sub-title">
                    Đọc đánh giá. Viết đánh giá. Tìm giáo viên. Tìm người dùng.
                </h2>
                <form class="hero__search-form search-form" autocomplete="false">
                    <span class="hero__search-form__placeholder-icon fa fa-search"></span>
                    <input class="hero__search-input search-input"
                        v-model="keyword"
                        @keyup.enter="searchRedirect"
                        @input="search"
                        placeholder="Tìm giáo viên... Tìm người dùng..."
                        type="text">
                    <button class="hero__search-form__submit" @click.prevent="searchRedirect" aria-label="Search">
                        <span class="hero__search-form__submit__text">Tìm kiếm</span>
                        <span class="hero__search-form__submit__icon fa fa-search"></span>
                    </button>
                </form>

            <div class="user-result">
                <template v-if="teachersFinded">
                    <div class="row activity-stream-card review-card search-result " v-for="result in teachersFinded"  :key="result.id">
                        <div class="col-md-2 review-card__header">
                            <img class="profile-image search-img"  :src="result.image" :alt="result.name" >
                        </div>
                        <div class="col-md-4">
                            <div :class="'star-rating star-rating-'+result.overView.star+' star-rating--medium'">
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
                            <div class="review-card__author" style="text-align:left">Rating: {{result.overView.count}}<br>Score: {{result.overView.avg }}/5
                            </div>
                        </div>
                        <div class="review-card__author" style="text-align:left">
                            <router-link :to="{name: 'detail_teacher', params:{ id: result.id }}">{{result.name}}</router-link>
                            <br>Chuyên môn: {{result.specialize}}
                            <br>Email: {{result.email}}
                        </div>
                    </div>
                </template>
                <template v-if="usersFinded">
                    <div class="row activity-stream-card review-card search-result " v-for="result in usersFinded"  :key="result.id">
                        <div class="col-md-2 review-card__header">
                            <img class="profile-image search-img" :src="result.avatar" :alt="result.name" >
                        </div>
                        <div class="review-card__author" style="text-align:left">
                            <router-link :to="{name:'profile_user' , params:{ id: result.id }}">{{result.name}}</router-link>
                            <br>Email: {{result.email}}
                        </div>
                    </div>
                </template>
            </div>
        </div>
        </section>

        <section class="stream">
            <h2 class="activity-stream-header">Đánh giá gần đây</h2>
            <div class="activity-stream-wrapper" >
                <div class="activity-stream-column-container" >
                    <template v-if="loading">
                        <div class="activity-stream-column" >
                            <VueContentLoading/>
                            <VueContentLoading/>
                        </div>
                        <div class="activity-stream-column" >
                            <VueContentLoading/>
                            <VueContentLoading/>
                        </div>
                        <div class="activity-stream-column" >
                            <VueContentLoading/>
                            <VueContentLoading/>
                        </div>
                        <div class="activity-stream-column" >
                            <VueContentLoading/>
                            <VueContentLoading/>
                        </div>
                        <div class="activity-stream-column" >
                            <VueContentLoading/>
                            <VueContentLoading/>
                        </div>
                    </template>
                    <template v-else>
                        <div class="activity-stream-column" >
                            <review v-for="review in reviews.slice(0, 2)" :review="review" :key="review.review.id"></review>
                        </div>
                        <div class="activity-stream-column" >
                            <review v-for="review in reviews.slice(2, 4)" :review="review" :key="review.review.id"></review>
                        </div>
                        <div class="activity-stream-column" >
                            <review v-for="review in reviews.slice(4, 6)" :review="review" :key="review.review.id"></review>
                        </div>
                        <div class="activity-stream-column" >
                            <review v-for="review in reviews.slice(6, 8)" :review="review" :key="review.review.id"></review>
                        </div>
                        <div class="activity-stream-column" >
                            <review v-for="review in reviews.slice(8, 10)" :review="review" :key="review.review.id"></review>
                        </div>
                    </template>


                </div>
            </div>
        </section>
</div>
</template>
<script>
    import _ from 'lodash'
    import { get } from "../../helpers/api"
    import { EventBus }  from '../../EventBus'
    import Review  from "../review/layoutReview";
    import VueContentLoading from 'vue-content-loading';
    import { getReviewLastest } from "../../router/router"
    export default {
        components: {
            Review,
            VueContentLoading
        },
        data() {
            return {
                reviews: [],
                keyword: '',
                usersFinded: [],
                teachersFinded: [],
                loading: false
            }
        },
        created () {
            EventBus.$on('redirect-page', () => {
                        this.keyword = ''
                        this.search()
                    })
        },
        mounted() {
            this.loading = true
            get(getReviewLastest).then((response) => {
                this.reviews = response.data.review_lastest.reviews
                this.loading = false
            });
            // this.$emit('loading',true)
        },
        methods:{
            search: _.debounce(function () {
            if (this.keyword.trim()) {
                get(`search?keyword=${this.keyword}`)
                    .then(res => {
                        this.usersFinded = res.data.users
                        this.teachersFinded = res.data.teachers
                    })
                    .catch(err => {
                        noty({
                            // text: this.$i18n.t('messages.connection_error'),
                            container: false,
                            force: true
                        })
                    })
            } else {
                 this.usersFinded = this.teachersFinded = []
            }
        }, 500),
        searchRedirect(){
            this.$router.push({ name: 'search', params: { keyword: this.keyword }})
            this.keyword = ''
            this.search()
        }
        }
    }

</script>

<style lang="scss" scoped>
#home{
    margin-top: 85px;
}
.search-result.activity-stream-card{
    padding-top: 6px;
    padding-bottom: 6px;
    margin:0px;
    border-top: 1px solid #e3f2fd;
}
.review-card__header .profile-image.search-img{
    width: 65px;
    height: 65px;
}
.user-result {
    position: absolute;
    /* height: 500px; */
    max-width: 600px;
    width: 100%;
    z-index: 999;
}
</style>
