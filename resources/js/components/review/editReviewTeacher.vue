<template>
    <div class="container pdt-6">
        <vue-headful
                :title="'Chỉnh sửa đánh giá '+teacherData.name+' | EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn'"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        />
        <div class="row">
            <div class="col-md-12">
                <h1>Đánh giá của bạn về giảng viên <router-link :to="{name:'profile_user' , params:{ id: teacherData.id }}">{{teacherData.name}}</router-link></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 form-review">
                <form @submit.prevent="editReviewTeacher">
                <div class="rating-star">
                    <span class="field-name">Rating</span>
                    <div class="star-selector__descriptions">
                    <span>Di chuột qua các ngôi sao hoặc nhấp để xếp hạng.</span>
                    </div>
                    <div class="quick-evaluate__rating">
                    <div class="quick-evaluate__rating-evaluate">
                        <div :class="'star-rating star-selector star-rating--large star-rating-'+review.rating">
                            <div class="star-item star-item--color">
                                    <img @mouseover="[cus = review.rating, review.rating = 1]"
                                        @mouseleave="review.rating = cus"
                                        @click="cus = review.rating=1"
                                        src="/images/single-star-transparent.svg" alt="Star 1">
                            </div>
                            <div class="star-item star-item--color">
                                    <img @mouseover="[cus = review.rating, review.rating = 2]"
                                        @mouseleave="review.rating = cus"
                                        @click="cus = review.rating = 2"
                                        src="/images/single-star-transparent.svg" alt="Star 2">
                            </div>
                            <div class="star-item star-item--color">
                                    <img @mouseover="[cus = review.rating, review.rating = 3]"
                                        @mouseleave="review.rating = cus"
                                        @click="cus = review.rating =3"
                                        src="/images/single-star-transparent.svg" alt="Star 3">
                            </div>
                            <div class="star-item star-item--color">
                                    <img @mouseover="[cus = review.rating, review.rating = 4]"
                                        @mouseleave="review.rating = cus"
                                        @click="cus = review.rating = 4"
                                        src="/images/single-star-transparent.svg" alt="Star 4">
                            </div>
                            <div class="star-item star-item--color">
                                    <img @mouseover="[cus = review.rating, review.rating = 5]"
                                        @mouseleave="review.rating = cus"
                                        @click="cus = review.rating = 5"
                                        src="/images/single-star-transparent.svg" alt="Star 5">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="star-selector__descriptions">
                    <span v-if="review.rating == 1" >1 star: Xấu - kinh nghiệm không thể chấp nhận, hành vi vô lý và thô lỗ.</span>
                    <span v-if="review.rating == 2" >2 stars: Kém - một trải nghiệm không đầy đủ với nhiều ý kiến trái chiều.</span>
                    <span v-if="review.rating == 3" >3 stars: Trung bình – kinh nghiệm chấp nhận được nhưng với một số ý kiến trái chiều.</span>
                    <span v-if="review.rating == 4" >4 stars: Tuyệt vời – đối xử tử tế và rất ít ý kiến trái chiều.</span>
                    <span v-if="review.rating == 5" >5 stars: Xuất sắc – sẽ giới thiệu với bất cứ ai muốn học.</span>
                </div>
                </div>
                <div class="rating-content">
                <span class="field-name">Ý kiến đánh giá của bạn</span>
                <textarea class="content-main-rate" v-model="review.description" placeholder="Chia sẻ kinh nghiệm trung thực của bạn và giúp người khác đưa ra lựa chọn tốt hơn."></textarea>
                </div>
                <div class="rating-title">
                <span class="field-name">Tiêu đề</span>
                <input type="text" class="content-main-rate" v-model="review.name">
                </div>
                <div class="submit-button">
                    <input class="btn btn-success btn-lg btn-rv" type="submit" value="Hoàn tất">
                </div>
                </form>
            </div>
            <div class="col-md-5 form-review">
                <!-- <div class="info-teacher">
                    <div class="card card--related">
                        <div class="card-left">
                            <h3 class="title-company-w fs-20">Thông tin</h3>
                            <p>Gender: {{teacherData.gender?'Male':'Female'}}</p>
                            <p>birthday: {{teacherData.birthday}}</p>
                            <p>address: {{teacherData.address}}</p>
                            <p>phone: {{teacherData.phone}}</p>
                            <p>specialize: {{teacherData.specialize}}</p>
                            <p>email: {{teacherData.email}}</p>
                        </div>
                    </div>
                    <div class="card card--related">
                        <div class="card-left">
                            <h3 class="title-company-w fs-20">Giới thiệu</h3>
                            <p>{{teacherData.description}}</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>
<script>
import { get, patch } from '../../helpers/api'
import noty from '../../helpers/noty'
import { getReview, editReview } from '../../router/router'
export default {
    name: 'app-review-edit',
    data: ()=>({
        review: {
            id:'',
            name:'',
            rating: '',
            description: ''
        },
        teacherData:[],
        cus: ''
    }),
    mounted() {
        get(getReview+this.$route.params.id)
            .then((res)=>{
                this.review.id               = res.data.detail_review.review.id
                this.review.name             = res.data.detail_review.review.name
                this.review.description      = res.data.detail_review.review.description
                this.review.rating           = res.data.detail_review.review.rating
                this.teacherData             = res.data.detail_review.info_review.teacher
                console.log(res.data.detail_review.review)
            })
            .catch((err)=>{
                if (err.response.data.http_status.code == 404 ||
                        err.response.data.http_status.code == 401) {
                        this.$router.replace('/not-found')
                    }
            })
    },
    methods: {
        editReviewTeacher(){
            this.$Progress.start()
            patch(editReview,this.review)
            .then((res)=>{
                this.$router.push({name: 'success_created_review', params: { id: this.review.id }})
                this.$Progress.finish()
            })
            .catch((err)=>{
                this.$Progress.fail()
            })
        }
    }
}
</script>

<style>
.col-md-7.form-review {
    padding: 50px 25px;
    background: #ffebeb;
    border: 1px solid #12cd6a;
}
.form-review .info-teacher>.card{
    margin-top:0;
    padding: 50px 25px;
}

.rating-content {
    margin: 25px auto;
}

span.field-name {
    display: block;
    font-style: italic;
    margin-bottom: 10px;
    font-size: 25px;
    font-weight: bolder;
    color: #9427d6;
}
input.btn.btn-success.btn-lg.btn-rv {
    width: 100%;
    margin-top: 25px;
}
textarea.content-main-rate {
    width: 100%;
    height: 130px;
}

input.content-main-rate {
    width: 100%;
    height: 35px;
}
.star-selector__descriptions {
    color:#7e7e7e;
    font-size:14px;
    font-style:italic;
    margin:0;
    padding-top:5px;
}
@media (max-width:768px) {
    .col-md-7.form-review {

    margin: 10px 15px;

}
}
    @media only screen and (max-width:570px){
        .star-selector__descriptions {
            float:none;
            width:auto;
            margin-top:10px;
            margin-bottom:25px;
            height:auto
        }
    }

</style>
