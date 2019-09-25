// Here is API router from server to avoid hardcode while development is

export const getUser = 'user'
export const handleLogin = 'login'
export const logout = 'logout'
export const register = 'register'
export const passwordEmail = 'password/email'
export const passwordReset = 'password/reset'
export const getReviewLastest = 'review/lastest'
export const postTeacher = 'teacher/new'
export const postReviewTeacher = 'review/new'
export const uploadFile = 'file/upload'
export const detailTeacher = 'teacher/show/'
export const detailUser = 'user/show/'
export const getReview = 'review/show/'
export const editReview = 'review/edit'
export const deleteReview = 'review/delete/'

export default {
    getUser,
    handleLogin,
    logout,
    register,
    passwordEmail,
    passwordReset,
    getReviewLastest,
    postTeacher,
    postReviewTeacher,
    uploadFile,
    detailTeacher,
    detailUser,
    getReview,
    editReview,
    deleteReview
}