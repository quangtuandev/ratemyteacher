<template>
    <div class="container mt-100  profile-third-section">

        <vue-headful title="EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn" description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên" />
        <div class="row">
            <div class="col-12 cus-row">
                <div class="oval-lg avatar-techer mb-3">
                    <img v-if="center !== null" :src="center.image" class="avatar-center"/>
                    <i v-else class="fa fa-university fa-5x" aria-hidden="true"></i>
                </div>
                <div class="d-md-flex align-items-center justify-content-between ml-3">
                    <div v-if="center !== null" class="heading-wrap mb-4 mb-md-0">
                        <h2 class="mb-3">{{ center.name }}</h2>
                        <p>Giới thiệu: {{ center.description }}</p>
                        <span>Địa chỉ: {{ center.address }}</span><br>
                        <span>Số điện thoại: </span>
                        <a :href="'tel:'+center.phone">{{ center.phone }}</a></br>
                        <span>Địa chỉ mail: </span>
                        <a :href="'mailto:'+center.email">{{ center.email }}</a>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-none" v-if="center !== null">
                    <div v-for="item in center.teachers" class="card-body p-4 p-md-5 border-bottom">
                        <div class="d-md-flex align-items-center position-relative">
                            <div class="title-wrap d-block d-md-flex align-items-center">
                                <div class="oval mr-3 my-3 my-md-0 avatar-techer">
                                    <img v-if="item.image != null" :src="item.image" class="avatar-techer-center"/>
                                    <i v-else class="fa fa-university fa-2x" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">
                                        <router-link :to="{name: 'detail_teacher', params: {id: item.id}}">{{ item.name }}</router-link>
                                    </h5>
                                    <h6 class="card-subtitle">{{ item.specialize }}</h6>
                                </div>
                            </div>
                            <div class="reviews-wrap col-md-9">
                                <p class="card-text mt-4 mt-md-0">
                                    {{ item.description }}
                                </p>
                            </div>
                        </div>
                        <div class="review-btn text-right">
                            <router-link class="btn btn-primary" :to="{name: 'create_review_teacher', params:{id: item.id}}">
                                <i class="fa fa-pencil"></i> Viết đánh giá
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { get } from '../../helpers/api.js'
    export default {
        name: 'list-teacher',
        data() {
            return {
                center: null,
            }
        },
        mounted() {
            get(`centers/${this.$route.params.id}`)
            .then(res => {
                this.center = res.data.center
            })
        },
    }
</script>
<style lang="css" scope>
    .mt-100 {
        margin-top: 100px;
    }
    .avatar-techer .avatar-center {
        width: 185px;
        height: 185px;
        border-radius: 50%;
    }
    .col-12.cus-row {
        display: flex;
    }
    .avatar-techer-center{
        width: 65px;
        height: 65px;
        border-radius: 50%;
    }
    .avatar-techer {
        overflow: unset;
    }
</style>
