<template>
    <div class="home">
        <div class="row">
            <div class="col-12 w-100per m-b-100 overflow-auto">
                <div class="w-1200 py-5 m-auto">
                    <h2 class="header text-center">
                        文书服务系统</h2>
                    <!--<p class="header-ad text-sm text-center letter-10  m-b-45">-->
                        <!--一次上传，多次生成，规范存档</p>-->

                </div>
            </div>
        </div>
        <div class="row">
            <div class="link col-12 text-center">
                <a href="http://www.hlqgroup.com">青岛市黄岛区人民法院</a><br>
                <span class="mt-5 mb-3 text-muted">技术支持：云数联科技</span>
                <p class="mt-5 mb-3 text-muted">© 2019-2020</p>
                <p class="mb-5 text-muted">备案号：鲁ICP备14021000号-1</p>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
//                shops: [],
                active: 0
            }
        },
        mounted() {
//            axios.get('/api/v1/shops').then(response => {
//                this.shops = response.data.data
//            })
        },
        methods: {
            showActive(index) {
                this.active = index;
            }
        }


    }
</script>

<style>
    .header{
        color: #505050;
        font-size:60px;
        margin: 120px 0;
    }
    .header-ad{
        color: #6a6866;
    }
    .link{
        padding: 0 10%;
    }
    .shop-title {
        width: 120px;
        height: 28px;
        line-height: 28px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .code-pics{
        width:96%;
        left:50%
    }
    .code-pics img {
        border-radius: 50%;
        box-shadow: 0 0 20px #e4e8eb !important;
    }

    .code-pics {
        /*float: right;*/
    }

    .code-pics ul {
        margin-left: 1px;
        padding-left: 0px !important;
    }

    .code-pics ul li {
        display: inline-block;
        margin: 20px 10px;
        width: 100px;
        height: 100px;
    }

    .code-pics ul li a {
        position: relative;
        display: inline-block;
        width: 100px;
        height: 100px;
    }

    .hide_tab {
        position: absolute;
        bottom: 0;
        z-index: 999;
        margin-left: -50px;
    }
</style>
