<template>
    <div class="mg-news">
        <el-dialog title="新建审批" :visible.sync="dialogFormVisible">
            <el-form :inline="true" ref="addForm" :model="addForm" label-width="80px" size="medium">
                <el-form-item label="姓名">
                    <el-input v-model="addForm.names" size="mini" placeholder="李雷"></el-input>
                </el-form-item>

                <el-form-item label="年龄">
                    <el-input v-model="addForm.age" size="mini" placeholder="50"
                              :rules="[{ required: true, message: '年龄不能为空'},{ type: 'number', message: '年龄必须为数字值'}]">
                    </el-input>
                </el-form-item>
                <el-form-item label="性别">
                    <el-radio-group v-model="addForm.gender" size="mini">
                        <el-radio label="男"></el-radio>
                        <el-radio label="女"></el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="单位">
                    <el-input v-model="addForm.department" size="mini" placeholder="区委组织部"></el-input>
                </el-form-item>
                <el-form-item label="职务">
                    <el-input v-model="addForm.duties" size="mini" placeholder="部长"></el-input>
                </el-form-item>
                <el-form-item label="级别">
                    <el-input v-model="addForm.level" size="mini" placeholder="副局"></el-input>
                </el-form-item>
                <el-form-item label="所属系统">
                    <el-input v-model="addForm.system_part" size="mini" placeholder="区委/区政府/功能区"></el-input>
                </el-form-item>
                <el-form-item label="自组随团">
                    <el-input v-model="addForm.by_group" size="mini" placeholder="随团/自组"></el-input>
                </el-form-item>
                <el-form-item label="出访类别">
                    <el-input v-model="addForm.visits_category" size="mini" placeholder="人才洽谈/技术培训"></el-input>
                </el-form-item>
                <el-form-item label="国家">
                    <el-input v-model="addForm.place_to" size="mini" placeholder="法国/德国"></el-input>
                </el-form-item>
                <el-form-item label="批件号">
                    <el-input v-model="addForm.batch_number" size="mini" placeholder="6"></el-input>
                </el-form-item>
                <el-form-item label="经费(万元)">
                    <el-input-number
                            v-model="addForm.funds"
                            :precision="2"
                            size="mini"
                            :step="0.10"
                            :min="0">
                    </el-input-number>
                </el-form-item>
                <el-form-item label="出访日期">
                    <el-date-picker
                            size="mini"
                            v-model="addForm.sendDate"
                            type="daterange"
                            start-placeholder="出访开始时间"
                            end-placeholder="结束时间"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="yyyy-MM-dd"
                            align="left"
                            :picker-options="pickerOptions2"
                    >
                    </el-date-picker>
                </el-form-item>
                <div class="form-group">
                    <el-form-item label="备注" size="mini">
                        <el-input class="textarea-width" type="textarea" v-model="addForm.remarks"
                                  placeholder="请填写备注信息"></el-input>
                    </el-form-item>
                </div>
                <div class="form-group news-img">
                    <label for="pic" class="col-form-label">图片:（建议2张，最多9张）</label>
                    <el-upload
                            ref="upload"
                            accept="image/*"
                            class="mg-upload-image"
                            :action="uploadAction"
                            list-type="picture-card"
                            multiple
                            :limit="9"
                            :on-exceed="handleExceed"
                            :on-success="handleSuccess"
                            :headers="headers">
                        <i class="el-icon-plus"></i>
                    </el-upload>
                </div>
            </el-form>

            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="addBroad">确 定</el-button>
            </div>
        </el-dialog>
        <el-dialog title="编辑审批事项" :visible.sync="editAbroadModalCenter">
            <el-form :inline="true" ref="abroadEditForm" :model="abroadEditForm" label-width="80px" size="medium">
                <el-form-item label="姓名">
                    <el-input v-model="abroadEditForm.names" size="mini" placeholder="李雷"></el-input>
                </el-form-item>

                <el-form-item label="年龄">
                    <el-input v-model="abroadEditForm.age" size="mini" placeholder="50">
                    </el-input>
                </el-form-item>
                <el-form-item label="性别">
                    <el-radio-group v-model="abroadEditForm.gender" size="mini">
                        <el-radio label="男"></el-radio>
                        <el-radio label="女"></el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="单位">
                    <el-input v-model="abroadEditForm.department" size="mini" placeholder="区委组织部"></el-input>
                </el-form-item>
                <el-form-item label="职务">
                    <el-input v-model="abroadEditForm.duties" size="mini" placeholder="部长"></el-input>
                </el-form-item>
                <el-form-item label="级别">
                    <el-input v-model="abroadEditForm.level" size="mini" placeholder="副局"></el-input>
                </el-form-item>
                <el-form-item label="所属系统">
                    <el-input v-model="abroadEditForm.system_part" size="mini" placeholder="区委/区政府/功能区"></el-input>
                </el-form-item>
                <el-form-item label="自组随团">
                    <el-input v-model="abroadEditForm.by_group" size="mini" placeholder="随团/自组"></el-input>
                </el-form-item>
                <el-form-item label="出访类别">
                    <el-input v-model="abroadEditForm.visits_category" size="mini" placeholder="人才洽谈/技术培训"></el-input>
                </el-form-item>
                <el-form-item label="国家">
                    <el-input v-model="abroadEditForm.place_to" size="mini" placeholder="法国/德国"></el-input>
                </el-form-item>
                <el-form-item label="批件号">
                    <el-input v-model="abroadEditForm.batch_number" size="mini" placeholder="5"></el-input>
                </el-form-item>
                <el-form-item label="经费(万元)">
                    <el-input-number
                            v-model="abroadEditForm.funds"
                            :precision="2"
                            size="mini"
                            :step="0.10"
                            :min="0">
                    </el-input-number>
                </el-form-item>
                <el-form-item label="出访日期">
                    <el-date-picker
                            size="mini"
                            v-model="abroadEditForm.sendDate"
                            type="daterange"
                            start-placeholder="出访开始时间"
                            end-placeholder="结束时间"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="yyyy-MM-dd"
                            align="left"
                            :picker-options="pickerOptions2"
                    >
                    </el-date-picker>
                </el-form-item>
                <div class="form-group">
                    <el-form-item label="备注" size="mini">
                        <el-input class="textarea-width" type="textarea" v-model="abroadEditForm.remarks"></el-input>
                    </el-form-item>
                </div>
                <div class="form-group news-img">
                    <label for="editImageUrl" class="col-form-label">图片:（建议2张，最多9张，请注意图片点击后直接删除）</label><br>
                    <!--<img class="edit-pic" v-for="image in abroadEditForm.pic"-->
                         <!--:src="image +'!mp.v50'" width="80" height="80"-->
                         <!--@click="handlePreview(image +'!mp.v720')"-->
                         <!--data-toggle="modal" data-target=".dynamic-image-lg">-->
                    <ul class="el-upload-list el-upload-list--picture-card">
                        <li tabindex="0" v-for="image in editImageUrl"  class="el-upload-list__item is-success" :headers="headers" @click="picRemove(image)">
                            <img :src="image +'!mp.v80'" width="80" height="80" alt=""
                                 class="el-upload-list__item-thumbnail">
                            <a class="el-upload-list__item-name">
                                <i class="el-icon-document"></i>
                            </a>
                            <label class="el-upload-list__item-status-label">
                                <i class="el-icon-upload-success el-icon-check"></i>
                            </label>
                            <i class="el-icon-close"></i>
                            <i class="el-icon-close-tip">按 delete 键可删除</i>
                            <span class="el-upload-list__item-actions">
                                <span class="el-upload-list__item-delete">
                                    <i class="el-icon-delete"></i>
                                </span>
                            </span>
                        </li>
                    </ul>
                    <el-upload
                            ref="upload"
                            class="mg-upload-image"
                            :action="uploadAction"
                            list-type="picture-card"
                            multiple
                            :limit="9"
                            :on-exceed="handleExceed"
                            :on-success="editSuccess"
                            :headers="headers">
                        <i class="el-icon-plus"></i>
                    </el-upload>
                </div>
            </el-form>

            <div slot="footer" class="dialog-footer">
                <el-button @click="editAbroadModalCenter = false">取 消</el-button>
                <el-button type="primary" @click="updateAbroad">保 存</el-button>
            </div>
        </el-dialog>
        <el-dialog title="复制新建同行程审批事项" :visible.sync="copyAbroadModalCenter">
            <el-form :inline="true" ref="abroadCopyForm" :model="abroadCopyForm" label-width="80px" size="medium">
                <div class="form-group">
                    <el-form-item label="行程编号" size="mini">
                        {{abroadCopyForm.number_id}}
                    </el-form-item>
                </div>
                <el-form-item label="姓名">
                    <el-input v-model="abroadCopyForm.names" size="mini" placeholder="李雷"></el-input>
                </el-form-item>

                <el-form-item label="年龄">
                    <el-input v-model="abroadCopyForm.age" size="mini" placeholder="50">
                    </el-input>
                </el-form-item>
                <el-form-item label="性别">
                    <el-radio-group v-model="abroadCopyForm.gender" size="mini">
                        <el-radio label="男"></el-radio>
                        <el-radio label="女"></el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="单位">
                    <el-input v-model="abroadCopyForm.department" size="mini" placeholder="区委组织部"></el-input>
                </el-form-item>
                <el-form-item label="职务">
                    <el-input v-model="abroadCopyForm.duties" size="mini" placeholder="部长"></el-input>
                </el-form-item>
                <el-form-item label="级别">
                    <el-input v-model="abroadCopyForm.level" size="mini" placeholder="副局"></el-input>
                </el-form-item>
                <el-form-item label="所属系统">
                    <el-input v-model="abroadCopyForm.system_part" size="mini" placeholder="区委/区政府/功能区"></el-input>
                </el-form-item>
                <el-form-item label="自组随团">
                    <el-input v-model="abroadCopyForm.by_group" size="mini" placeholder="随团/自组"></el-input>
                </el-form-item>
                <el-form-item label="出访类别">
                    <el-input v-model="abroadCopyForm.visits_category" size="mini" placeholder="人才洽谈/技术培训"></el-input>
                </el-form-item>
                <el-form-item label="国家">
                    <el-input v-model="abroadCopyForm.place_to" size="mini" placeholder="法国/德国"></el-input>
                </el-form-item>
                <el-form-item label="批件号">
                    <el-input v-model="abroadCopyForm.batch_number" size="mini" placeholder="5"></el-input>
                </el-form-item>
                <el-form-item label="经费(万元)">
                    <el-input-number
                            v-model="abroadCopyForm.funds"
                            :precision="2"
                            size="mini"
                            :step="0.10"
                            :min="0">
                    </el-input-number>
                </el-form-item>
                <el-form-item label="出访日期">
                    <el-date-picker
                            size="mini"
                            v-model="abroadCopyForm.sendDate"
                            type="daterange"
                            start-placeholder="出访开始时间"
                            end-placeholder="结束时间"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="yyyy-MM-dd"
                            align="left"
                            :picker-options="pickerOptions2"
                    >
                    </el-date-picker>
                </el-form-item>
                <div class="form-group">
                    <el-form-item label="备注" size="mini">
                        <el-input class="textarea-width" type="textarea" v-model="abroadCopyForm.remarks"></el-input>
                    </el-form-item>
                </div>
                <div class="form-group news-img">
                    <label for="editImageUrl" class="col-form-label">图片:（建议2张，最多9张）</label><br>
                    <ul class="el-upload-list el-upload-list--picture-card">
                        <li tabindex="0" v-for="image in editImageUrl"  class="el-upload-list__item is-success" :headers="headers">
                            <img :src="image +'!mp.v80'" width="80" height="80" alt=""
                                 class="el-upload-list__item-thumbnail">
                            <a class="el-upload-list__item-name">
                                <i class="el-icon-document"></i>
                            </a>
                            <label class="el-upload-list__item-status-label">
                                <i class="el-icon-upload-success el-icon-check"></i>
                            </label>
                            <i class="el-icon-close"></i>
                        </li>
                    </ul>
                    <el-upload
                            ref="upload"
                            class="mg-upload-image"
                            :action="uploadAction"
                            list-type="picture-card"
                            multiple
                            :limit="9"
                            :on-exceed="handleExceed"
                            :on-success="editSuccess"
                            :headers="headers">
                        <i class="el-icon-plus"></i>
                    </el-upload>
                </div>
            </el-form>

            <div slot="footer" class="dialog-footer">
                <el-button @click="copyAbroadModalCenter = false">取 消</el-button>
                <el-button type="primary" @click="addCopyBroad">新 增</el-button>
            </div>
        </el-dialog>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3 border-0">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="header-text-container">
                                    <div class="mb-3">
                                        <el-row>
                                            <el-col :span="8">
                                                <span class="broad-title">
                                                    <span class="text-success text-bold m-r-5">|</span>
                                                    因公出国（境）团组统计表
                                                </span>
                                            </el-col>
                                            <el-col :span="10">
                                                <div class="block">
                                                    <el-autocomplete
                                                            v-model="stateName"
                                                            :fetch-suggestions="querySearchAsync"
                                                            placeholder="姓名查询"
                                                            @select="handleSelect"
                                                            prefix-icon="el-icon-search"
                                                    ></el-autocomplete>
                                                    <el-autocomplete
                                                            v-model="stateDepartment"
                                                            :fetch-suggestions="querySearchDepartment"
                                                            placeholder="部门查询"
                                                            @select="DepartmentSelect"
                                                            prefix-icon="el-icon-search"
                                                    ></el-autocomplete>
                                                </div>

                                            </el-col>
                                            <el-col :span="6">
                                                <el-button style="float: right;" type="success" icon="el-icon-refresh" @click="Refresh">刷新重置
                                                </el-button>
                                                <el-button style="float: right; margin-right:10px;" type="primary"
                                                           icon="el-icon-circle-plus"
                                                           @click="dialogFormVisible = true">新建审批
                                                </el-button>
                                            </el-col>
                                        </el-row>
                                    </div>
                                    <div class="body-container">
                                        <div class="my-3 border-top">
                                            <el-table
                                                    :row-class-name="tableRowClassName"
                                                    @cell-dblclick="dialogFormVisible = true"
                                                    :data="abroads"
                                                    align="left"
                                                    style="width: 100%"
                                            >
                                                <el-table-column
                                                        prop="number_hidden"
                                                        label="编号"
                                                        sortable
                                                        width="75"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="batch_number"
                                                        label="批文"
                                                        sortable
                                                        width="75"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="name"
                                                        label="姓名"
                                                        width="80"
                                                >
                                                    <template slot-scope="scope">
                                                        <span :class="scope.row.gender==='女'?'blue':''" >{{scope.row.name}}</span>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column
                                                        prop="department"
                                                        label="单位"
                                                        sortable
                                                        width="100"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="duties"
                                                        label="职务/级别"
                                                        sortable
                                                        width="110"
                                                >
                                                    <template slot-scope="scope">
                                                        <span>{{scope.row.duties}}</span>
                                                        <span>({{scope.row.level}})</span>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column
                                                        prop='system_part'
                                                        label="所属系统"
                                                        width="80"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="by_group"
                                                        label="自组随团"
                                                        width="80"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="visits_category"
                                                        label="出访类别"
                                                        width="100"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="place_to"
                                                        label="国家/停留时间"
                                                        :formatter="placeToDays"
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="times_at"
                                                        label="出访日期"
                                                        :formatter="timesToEnd"
                                                        sortable
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="funds"
                                                        label="经费(万元)"
                                                        sortable
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        width="110"
                                                        label="附件"
                                                >
                                                    <template slot-scope="scope">
                                                        <img class="pics" v-for="image in scope.row.pic"
                                                             :src="image +'!mp.v50'" width="36" height="36"
                                                             @click="handlePreview(image +'!mp.v720')"
                                                             data-toggle="modal" data-target=".dynamic-image-lg">
                                                    </template>
                                                </el-table-column>
                                                <el-table-column
                                                        prop="remarks"
                                                        label="备注"
                                                        sortable
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        fixed="right"
                                                        label="操作"
                                                        width="150"
                                                >
                                                    <template slot-scope="scope">
                                                        <el-tooltip class="item" effect="dark"
                                                                    content="复制新建"
                                                                    placement="left">
                                                            <el-button
                                                                    @click="copyAbroadModalCenter = true"
                                                                    @click.native.prevent="handleEdit(scope.$index, scope.row)"
                                                                    icon="el-icon-plus"
                                                                    size="mini" circle>
                                                            </el-button>
                                                        </el-tooltip>
                                                        <el-tooltip class="item" effect="dark"
                                                                    content="编辑"
                                                                    placement="top">
                                                            <el-button
                                                                    @click="editAbroadModalCenter = true"
                                                                    @click.native.prevent="handleEdit(scope.$index, scope.row)"
                                                                    type="primary" icon="el-icon-edit"
                                                                    size="mini" circle>
                                                            </el-button>
                                                        </el-tooltip>
                                                        <el-tooltip class="item" effect="dark"
                                                                    content="删除"
                                                                    placement="top">
                                                            <el-button
                                                                    @click.native.prevent="handleDelete(scope.$index, scope.row)"
                                                                    type="info" icon="el-icon-delete"
                                                                    size="mini" circle>
                                                            </el-button>
                                                        </el-tooltip>
                                                    </template>
                                                </el-table-column>
                                            </el-table>
                                        </div>
                                        <el-pagination
                                                @size-change="handleSizeChange"
                                                @current-change="handleCurrentChange"
                                                :current-page="currentPage"
                                                :page-sizes="[9, 20, 100, 300]"
                                                :page-size="9"
                                                :pager-count="pagerCount"
                                                layout="total, sizes, prev, pager, next, jumper"
                                                :total="pagination.total">
                                        </el-pagination>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <el-dialog title="图片预览" :visible.sync="handlePreviewModal">
            <img width="100%" :src="dialogImageUrl"
                 alt="" data-toggle="modal" data-target=".dynamic-image-lg">
        </el-dialog>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {

        data() {
            return {
                abroads: [],
                pagination: {
                    total: 0,
                    per_page: 0,
                    from: 0,
                    to: 0,
                    current_page: 1
                },
                currentPage: 1,
                offset: 9,
                pagerCount: 5,
                addForm: {funds: '1.00', gender: '男'},
                abroadEditForm: {funds: '1.00', gender: '男', sendDate: [], pic: []},
                abroadCopyForm: {funds: '1.00', gender: '男', sendDate: [], pic: []},
                dialogTableVisible: false,
                dialogFormVisible: false,
                editAbroadModalCenter: false,
                copyAbroadModalCenter:false,
                handlePreviewModal: false,
                pickerOptions2: {
                    shortcuts: [{
                        text: '三周后',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            end.setTime(start.getTime() + 3600 * 1000 * 24 * 21);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: '一个月后',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            end.setTime(start.getTime() + 3600 * 1000 * 24 * 30);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: '两个月后',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            end.setTime(start.getTime() + 3600 * 1000 * 24 * 60);
                            picker.$emit('pick', [start, end]);
                        }
                    }]
                },
                pic: '',
                pics: [],
                fileList: [],
                dialogImageUrl: '',
                dialogVisible: false,
                uploadAction: '/api/v1/abroad/upFile',
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('jwt_token')
                },
                imageUrl: [],
                editImageUrl:[],
                queryName: [],
                stateName: '',
                queryDepartment: [],
                stateDepartment: '',
            }
        },
        mounted() {
            axios.get('/api/v1/abroads').then(response => {
                this.abroads = response.data.data
                this.pagination = response.data.meta
            })
            this.queryName = this.loadNames()
            this.queryDepartment = this.loadDepartments()
        },
        methods: {
            tableRowClassName({row, rowIndex}) {
                if (row.batch_number === '' ||row.batch_number === null) {
                    return 'warning-row';
                }
                return '';
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/abroads?page=' + page).then(response => {
                    this.abroads = response.data.data
                })
            },
            handleSizeChange(pageSize) {
                this.pagination.per_page = pageSize
                const formData = {
                    pagination: pageSize,
                }
                axios.post('/api/v1/abroad/listSize', formData).then(response => {
                    this.abroads = response.data.data
                })
            },
            handleCurrentChange(page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/abroads?page=' + page).then(response => {
                    this.abroads = response.data.data
                })
            },
            Refresh(page) {
                axios.get('/api/v1/abroads').then(response => {
                    this.abroads = response.data.data
                    this.pagination = response.data.meta
                    this.stateName=''
                    this.stateDepartment=''
                })
            },
            placeToDays: function (row, column) {
                if (row.days == null || row.days == '') {
                    var todays = ''
                } else {
                    todays = '(' + row.days + '天' + ')'
                }
                return row.place_to + todays;
            },
            timesToEnd: function (row, column) {
                return row.times_at_md + '至' + row.times_end_md;
            },
            batchNumber: function (row, column) {
                return row.batch_number
            },
            handleSuccess(response){
                this.filesUrl = response.photo
                this.imageUrl.push(this.filesUrl)
            },
            editSuccess(response){
                if(this.editImageUrl==null){
                    this.editImageUrl=[]
                }
                this.filesUrl = response.photo
                this.editImageUrl.push(this.filesUrl)
            },
            handleBefore(){
                return this.files.length === 9 ? false : true // 只让它上传一张
            },
            handleRemove(file, fileList) {
                console.log(fileList);
            },
            picRemove(image) {
                const formData = {
                    id: this.abroadEditForm.id,
                    pic: image,
                }
                axios.post('/api/v1/abroad/destroyImage', formData).then(response => {
                    console.log(response.data)
                    this.editImageUrl = response.data
                })
            },
            handlePreview(image) {
                this.handlePreviewModal = true;
                this.dialogImageUrl = image;
            },
            handleExceed(files, fileList) {
                this.$message.warning(`当前限制选择 9 个文件，本次选择了 ${files.length} 个文件，共选择了 ${files.length + fileList.length} 个文件`);
            },
            addBroad() {
                const formData = {
                    names: this.addForm.names,
                    department: this.addForm.department,
                    gender: this.addForm.gender,
                    age: this.addForm.age,
                    duties: this.addForm.duties,
                    level: this.addForm.level,
                    system_part: this.addForm.system_part,
                    place_to: this.addForm.place_to,
                    batch_number: this.addForm.batch_number,
                    funds: this.addForm.funds,
                    remarks: this.addForm.remarks,
                    sendDate: this.addForm.sendDate,
                    by_group: this.addForm.by_group,
                    visits_category: this.addForm.visits_category,
                    reasons_visit: this.addForm.reasons_visit,
                    pic: this.imageUrl
                }
                axios.post('/api/v1/abroads', formData).then(response => {
                    this.abroads = response.data.abroads
                    this.dialogTableVisible = false
                    this.dialogFormVisible = false
                    this.imageUrl = []
                    this.fileList = []
                    this.$refs.upload.clearFiles()
                })
            },
            addCopyBroad() {
                const formData = {
                    names: this.abroadCopyForm.names,
                    number_id: this.abroadCopyForm.number_id,
                    department: this.abroadCopyForm.department,
                    gender: this.abroadCopyForm.gender,
                    age: this.abroadCopyForm.age,
                    duties: this.abroadCopyForm.duties,
                    level: this.abroadCopyForm.level,
                    system_part: this.abroadCopyForm.system_part,
                    place_to: this.abroadCopyForm.place_to,
                    batch_number: this.abroadCopyForm.batch_number,
                    funds: this.abroadCopyForm.funds,
                    remarks: this.abroadCopyForm.remarks,
                    sendDate: this.abroadCopyForm.sendDate,
                    by_group: this.abroadCopyForm.by_group,
                    visits_category: this.abroadCopyForm.visits_category,
                    reasons_visit: this.abroadCopyForm.reasons_visit,
                    pic: this.editImageUrl
                }
                axios.post('/api/v1/abroads', formData).then(response => {
                    this.abroads = response.data.abroads
                    this.copyAbroadModalCenter = false
                    this.imageUrl = []
                    this.fileList = []
                    this.$refs.upload.clearFiles()
                })
            },
            handleEdit(index, row) {
                this.abroadEditForm.id = row.id
                this.abroadEditForm.number_id = row.number_id
                this.abroadEditForm.names = row.name
                this.abroadEditForm.department = row.department
                this.abroadEditForm.gender = row.gender
                this.abroadEditForm.age = row.age
                this.abroadEditForm.duties = row.duties
                this.abroadEditForm.level = row.level
                this.abroadEditForm.system_part = row.system_part
                this.abroadEditForm.place_to = row.place_to
                this.abroadEditForm.batch_number = row.batch_number
                this.abroadEditForm.funds = row.funds
                this.abroadEditForm.remarks = row.remarks
                this.abroadEditForm.sendDate = [row.times_at, row.times_end]
                this.abroadEditForm.by_group = row.by_group
                this.abroadEditForm.visits_category = row.visits_category
                this.abroadEditForm.reasons_visit = row.reasons_visit
                this.editImageUrl = row.pic
                this.abroadCopyForm.id = row.id
                this.abroadCopyForm.number_id = row.number_id
                this.abroadCopyForm.names = row.name
                this.abroadCopyForm.department = row.department
                this.abroadCopyForm.gender = row.gender
                this.abroadCopyForm.age = row.age
                this.abroadCopyForm.duties = row.duties
                this.abroadCopyForm.level = row.level
                this.abroadCopyForm.system_part = row.system_part
                this.abroadCopyForm.place_to = row.place_to
                this.abroadCopyForm.batch_number = row.batch_number
                this.abroadCopyForm.funds = row.funds
                this.abroadCopyForm.remarks = row.remarks
                this.abroadCopyForm.sendDate = [row.times_at, row.times_end]
                this.abroadCopyForm.by_group = row.by_group
                this.abroadCopyForm.visits_category = row.visits_category
                this.abroadCopyForm.reasons_visit = row.reasons_visit
            },
            updateAbroad(){
                const formData = {
                    id: this.abroadEditForm.id,
                    number_id: this.abroadEditForm.number_id,
                    names: this.abroadEditForm.names,
                    department: this.abroadEditForm.department,
                    gender: this.abroadEditForm.gender,
                    age: this.abroadEditForm.age,
                    duties: this.abroadEditForm.duties,
                    level: this.abroadEditForm.level,
                    system_part: this.abroadEditForm.system_part,
                    place_to: this.abroadEditForm.place_to,
                    batch_number: this.abroadEditForm.batch_number,
                    funds: this.abroadEditForm.funds,
                    remarks: this.abroadEditForm.remarks,
                    sendDate: this.abroadEditForm.sendDate,
                    by_group: this.abroadEditForm.by_group,
                    visits_category: this.abroadEditForm.visits_category,
                    reasons_visit: this.abroadEditForm.reasons_visit,
                    pic: this.editImageUrl
                }
                axios.post('/api/v1/abroad/update', formData).then(response => {
                    axios.get('/api/v1/abroads?page=' + this.pagination.current_page).then(response => {
                        this.abroads = response.data.data
                    })
                    this.editAbroadModalCenter = false
                    this.imageEditUrl = []
                    this.fileList = []
                    this.$refs.upload.clearFiles()
                })
            },
            handleDelete(index, row) {
                axios.delete('/api/v1/abroads/' + row.id).then(response => {
                    axios.get('/api/v1/abroads?page=' + this.pagination.current_page).then(response => {
                        this.abroads = response.data.data
                    })
                })
            },
            loadNames() {
                return [
                    axios.get('/api/v1/abroad/queryNameList').then(response => {
                        this.queryName = response.data
                    })
                ]
            },
            loadDepartments() {
                return [
                    axios.get('/api/v1/abroad/queryDepartmentList').then(response => {
                        this.queryDepartment = response.data
                    })
                ]
            },
            querySearchAsync(queryString, cb) {
                var queryName = this.queryName;
                var results = queryString ? queryName.filter(this.createStateFilter(queryString)) : queryName;

                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    cb(results);
                }, 1000 * Math.random());
            },
            querySearchDepartment(queryString, cb) {
                var queryDepartment = this.queryDepartment;
                var results = queryString ? queryDepartment.filter(this.createStateFilter(queryString)) : queryDepartment;

                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    cb(results);
                }, 1000 * Math.random());
            },
            createStateFilter(queryString) {
                return (state) => {
                    return (state.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
                };
            },
            handleSelect(item) {
                const formData = {
                    name: item.value,
                }
                axios.post('/api/v1/abroad/queryResult',formData).then(response => {
                    console.log(response.data)
                    this.abroads = response.data.data
                    this.pagination = response.data.meta
                })
            },
            DepartmentSelect(item) {
                const formData = {
                    department: item.value,
                }
                axios.post('/api/v1/abroad/queryResult',formData).then(response => {
                    console.log(response.data)
                    this.abroads = response.data.data
                    this.pagination = response.data.meta
                })
            },
        },

        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
        },
    }

</script>
<style>
    .blue{
        color: #368ec9;
    }
    .red{
        color: #f06307;
    }
    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #f06307;
        border-color: #f06307;
    }

    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #f06307;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .page-link:hover {
        color: #f06307;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .el-table .warning-row {
        background: oldlace;
    }

    .el-table .success-row {
        background: #f0f9eb;
    }

    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 80px;
        margin: 0 1px 1px 0;
    }

    .mg-news .card-img {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }

    .bd-example-border-utils [class^=border] {
        display: inline-block;
        width: 18%;
        height: 5rem;
        margin: .25rem;
        background-color: #f5f5f5;
    }

    .el-button + .el-button {
        margin-left: 0px;
        /*margin-top: 3px;*/
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }

    .mg-upload-image .el-upload--picture-card {
        background-color: #fbfdff;
        border: 1px dashed #c0ccda;
        border-radius: 6px;
        box-sizing: border-box;
        width: 82px;
        height: 82px;
        line-height: 82px;
        vertical-align: top;
    }

    .mg-upload-image .el-upload-list--picture-card .el-upload-list__item {
        width: 82px;
        height: 82px;
    }

    .tags .el-select {
        display: block;
    }

    .el-date-table td.current:not(.disabled) span {
        color: #fff;
        background-color: #f06307;
    }

    .el-date-table td.today span {
        color: #f06307;
        font-weight: 700;
    }

    .el-radio__input.is-checked .el-radio__inner {
        border-color: #f06307;
        background: #f06307;
    }

    .el-radio__input.is-checked + .el-radio__label {
        color: #f06307;
    }

    .el-button--primary {
        color: #fff;
        background-color: #f06307;
        border-color: #f06307;
    }

    .tags .el-select {
        display: block;
    }

    .el-slider__bar {
        background-color: #f06307;
    }

    .el-slider__button {
        border: 2px solid #f06307;
        background-color: #fff;
    }

    .el-switch.is-checked .el-switch__core {
        border-color: #f06307;
        background-color: #f06307;
    }

    .el-range-editor.is-active, .el-range-editor.is-active:hover {
        border-color: #f06307;
    }

    .el-select .el-input.is-focus .el-input__inner {
        border-color: #f06307;
    }

    .el-input__inner:focus {
        border-color: #f06307;
        outline: 0;
    }

    .el-select-dropdown.is-multiple .el-select-dropdown__item.selected {
        color: #f06307;
        background-color: #fff;
    }

    .el-select-dropdown__item.selected {
        color: #f06307;
        font-weight: 700;
    }

    .el-date-table td.end-date span, .el-date-table td.start-date span {
        background-color: #f06307;
    }

    .is-payment .el-switch__label.is-active {
        color: #f06307;
    }

    .is-state .el-switch__label.is-active {
        color: rgb(135, 204, 130);
    }

    .el-button:focus, .el-button:hover {
        background: #28a745 !important;
        border-color: #28a745 !important;
        color: #fff;
    }

    .checkLocation-button {
        padding: 2px !important;
    }

    .selectClassify .el-select .el-input {
        width: 130px;
    }

    .input-with-select .el-input-group__prepend {
        background-color: #fff;
    }
    .el-pager li.active {
        color: #f06307;
        cursor: default;
    }
    .el-pager li:hover {
        color: #f06307;
        cursor: default;
    }
    .el-pagination button:hover {
        color: #f06307;
    }
    .broad-title {
        font-size: 28px;
    }

    .el-radio-group {
        vertical-align: unset;
    }

    .news-img {
        margin-left: 80px;
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }

    .mg-upload-image .el-upload--picture-card {
        background-color: #fbfdff;
        border: 1px dashed #c0ccda;
        border-radius: 6px;
        box-sizing: border-box;
        width: 82px;
        height: 82px;
        line-height: 82px;
        vertical-align: top;
    }
    .mg-upload-image .el-upload-list--picture-card .el-upload-list__item {
        width: 82px;
        height: 82px;
    }
    .el-upload-list--picture-card .el-upload-list__item {
        overflow: hidden;
        background-color: #fff;
        border: 1px solid #c0ccda;
        border-radius: 6px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        width: 82px;
        height: 82px;
        margin: 0 8px 8px 0;
        display: inline-block;
    }
    .tags .el-select {
        display: block;
    }

    .batch_number {
        display: table-cell;
        vertical-align: middle;
    }
    .batch-number{
        float: left;
        text-align: center;
        width: 34px;
        height: 34px;
        line-height: 12px;
        border: 1px solid #f4f4f4;
        border-radius: 5px;
        background-color: #fff;
        margin: 0 2px 2px 0;
    }
    .batch-number-name{
        position: absolute;
        top: 50%;
        height: 240px;
        margin-top: -120px;
    }
    .pics {
        border-radius: 5px;
        float: left;
        padding: 0 2px 2px 0;
    }

    .edit-pic {
        border-radius: 5px;
        float: left;
        padding: 0 2px 2px 0;
    }

    .textarea-width {
        width: 350px !important;
    }
    .el-table .warning-row {
        background: oldlace;
    }

    .el-table .success-row {
        background: #f0f9eb;
    }
</style>
