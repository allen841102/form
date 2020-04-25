<template>
    <div>
        <el-row>
            <el-col :span="18" class="right-border">
                <div class="grid-content">
                    <div style="margin: 20px;"></div>
                    <el-col :span="22">
                        <el-divider content-position="left">基本設定</el-divider>
                        <el-form
                                :model="survey"
                                :rules="rules"
                                class="demo-ruleForm"
                                label-position="left"
                                label-width="120px"
                                ref="ruleForm"
                                status-icon>
                            <el-form-item label="主題" prop="name">
                                <el-input clearable
                                          maxlength="50"
                                          placeholder="某某某研究調查"
                                          show-word-limit
                                          type="text"
                                          v-model="survey.name"></el-input>
                            </el-form-item>
                            <el-form-item label="開頭說明訊息" prop="startText">
                                <el-input maxlength="255"
                                          placeholder="您好，請協助我們了解這次服務的品質，以做為改進的參考。同時我們也將在月底抽出 10 位得獎者，寄發 8 折優惠券。"
                                          show-word-limit
                                          type="textarea"
                                          v-model="survey.start_text"></el-input>
                            </el-form-item>
                            <el-form-item label="Thank you 訊息" prop="endText">
                                <el-input maxlength="255"
                                          placeholder="完成，謝謝您的寶貴回饋。祝您有愉快的一天。"
                                          show-word-limit
                                          type="textarea"
                                          v-model="survey.end_text"></el-input>
                            </el-form-item>

                            <el-divider content-position="left">題目設定</el-divider>

                            <draggable :list="survey.questions"
                                       group="question-list"
                            >
                                <transition-group name="question-list" type="transition">
                                    <div :key="index+1"
                                         class="question-item" v-for="(question, index) in survey.questions">

                                        <el-form-item :label=" '題目' + String(index+1) ">
                                            <el-input class="question-input"
                                                      clearable
                                                      placeholder="標題"
                                                      type="text"
                                                      v-model="question.title">
                                            </el-input>
                                        </el-form-item>
                                        <div class="question-setting">
                                            <el-tag :class="getClassName(question.type)" class="margin-bot"
                                                    type="warning">
                                                {{ getTypeName(question.type)}}
                                            </el-tag>
                                            <el-tag class="sort-btn margin-bot" type="primary">
                                                <i class="el-icon-rank">排序</i>
                                            </el-tag>
                                            <el-button @click="removeQuestion(index)" class="margin-bot" size="small"
                                                       type="danger">
                                                <i class="el-icon-delete">刪除</i>
                                            </el-button>
                                            <el-switch :active-text="question.required ? '必填':'選填'"
                                                       class="margin-bot"
                                                       v-model="question.required">
                                            </el-switch>
                                        </div>
                                        <el-form-item :key="seq"
                                                      v-for="(answer, seq) in question.answers"
                                                      v-if="question.type !== 3">
                                            <el-col :span="20">
                                                <el-input clearable
                                                          placeholder="請輸入內容"
                                                          type="text"
                                                          v-model="answer.text">
                                                    <template slot="prepend">答案 {{ seq+1 }}</template>
                                                </el-input>
                                            </el-col>
                                            <el-col :span="4" style="text-align: left">
                                                <i @click="addAnswer(question.answers)"
                                                   class="el-icon-plus answer-ctrl"></i>
                                                <i @click="removeAnswer(question.answers, seq)"
                                                   class="el-icon-minus answer-ctrl"
                                                   v-show="question.answers.length > 1"></i>
                                            </el-col>
                                        </el-form-item>

                                        <el-form-item v-if="question.type==3">
                                            <el-input disabled
                                                      type="text">
                                            </el-input>
                                        </el-form-item>
                                    </div>
                                </transition-group>
                            </draggable>

                            <el-form-item v-show="survey.questions.length > 0">
                                <el-button @click="submitForm('ruleForm')" class="big-btn" type="primary">送出</el-button>
                                <!--                    <el-button @click="resetForm('ruleForm')">Reset</el-button>-->
                            </el-form-item>
                            <span class="empty-question-area" v-show="survey.questions.length===0"> 請加入題目 </span>
                        </el-form>
                    </el-col>
                </div>
            </el-col>
            <el-col :span="6">
                <div class="grid-content">
                    新增題目類型，拖曳至左方題目設定
                    <draggable
                            :clone="cloneQuestion"
                            :group="{ name: 'question-list', pull: 'clone', put: false }"
                            :list="questionOptions"
                            class="dragArea list-group"
                    >
                        <el-button
                                :icon="option.icon"
                                :key="option.type"
                                class="question-option"
                                v-for="option in questionOptions">{{option.text}}
                        </el-button>
                    </draggable>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import draggable from 'vuedraggable';
    import axios from 'axios';

    export default {
        props: {
            userSurvey: {
                type: Object,
                required: false,
            }
        },
        components: {
            draggable
        },
        data() {
            var validateTopic = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('請輸入主題'))
                }
                callback()
            }
            var validateStartText = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('請輸入開始說明訊息'))
                }
                callback()
            }
            var validateEndText = (rule, value, callback) => {
                if (!value) {
                    callback(new Error('請輸入 Thank you 訊息'));
                }
                callback()
            };
            return {
                rules: {
                    name: [
                        {validator: validateTopic, trigger: 'blur'}
                    ],
                    start_text: [
                        {validator: validateStartText, trigger: 'blur'}
                    ],
                    end_text: [
                        {validator: validateEndText, trigger: 'blur'}
                    ]
                },
                questionOptions: [
                    {
                        type: 1,
                        icon: 'el-icon-question',
                        text: "單選",
                    },
                    {
                        type: 2,
                        icon: 'el-icon-check',
                        text: "多選",
                    },
                    {
                        type: 3,
                        icon: 'el-icon-edit',
                        text: "簡答"
                    },
                ],
                survey: {},
                isNew: true,
            }
        },
        created() {
            let {name, start_text, end_text, contents} = this.userSurvey || {}
            this.survey = {
                name: name || '',
                start_text: start_text || '',
                end_text: end_text || '',
                questions: contents || []
            }
            console.log(this.survey)
            if (this.userSurvey) {
                this.isNew = false
            }
        },
        methods: {
            submitForm(formName) {
                console.log(this.survey)
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        if (this.isNew) {
                            this.createSurvey()
                        } else {
                            this.updateSurvey()
                        }
                    } else {
                        console.log('error submit!!')
                        return false;
                    }
                });
            },
            createSurvey() {
                axios.post('/admin/survey/create', this.survey)
                    .then(function (response) {
                        alert('建立成功 ' + JSON.stringify(response.data))
                        window.location.href = response.data.url
                    })
                    .catch(function (error, reason) {
                        if (error.response) {
                            alert(JSON.stringify(error.response))
                        } else {
                            alert(error)
                        }
                    })
            },
            updateSurvey() {
                axios.put('/admin/survey/' + this.userSurvey.id, this.survey)
                    .then(function (response) {
                        alert('更新成功 ' + JSON.stringify(response.data))
                        //window.location.href = response.data.url
                    })
                    .catch(function (error, reason) {
                        if (error.response) {
                            alert(JSON.stringify(error.response))
                        } else {
                            alert(error)
                        }
                    })
            },
            getTypeName(typeId) {
                return this.questionOptions.find(item => {
                    return typeId === item.type;
                }).text;
            },
            getClassName(typeId) {
                return this.questionOptions.find(item => {
                    return typeId === item.type;
                }).icon;
            },
            cloneQuestion(questionOption) {
                let newQuestion = {
                    id: null,
                    title: "",
                    type: questionOption.type,
                    required: false,
                    answers: [
                        {id: null, text: null}
                    ],
                }
                if (this.survey.questions.length === 0) {
                    this.survey.questions = [newQuestion]
                    return
                }
                return newQuestion
            },
            removeQuestion(index) {
                this.survey.questions.splice(index, 1)
            },
            addAnswer(answers) {
                answers.push({id: null, text: null})
            },
            removeAnswer(answers, index) {
                answers.splice(index, 1)
            }
        }
    }
</script>

<style>
    .el-row {
        margin-bottom: 20px;

    &
    :last-child {
        margin-bottom: 0;
    }

    }
    .question-input .el-input__inner {
        border: 0 none;
        border-bottom: 1px solid #ccc;
        border-radius: 0px;
    }

    .el-col {
        border-radius: 4px;
    }

    .bg-purple-dark {
        background: #99a9bf;
    }

    .bg-purple {
        background: #d3dce6;
    }

    .bg-purple-light {
        background: #e5e9f2;
    }

    .grid-content {
        border-radius: 4px;
        min-height: 36px;
        text-align: center;
    }

    .row-bg {
        padding: 10px 0;
        background-color: #f9fafc;
    }

    .el-divider {
        margin-bottom: 30px;
        margin-top: 30px;
    }

    .question-item {
        border-left: 5px solid #c7f0f5;
        padding-left: 10px;
        min-height: 210px;
        margin-bottom: 10px;
    }

    .sort-btn {
        cursor: all-scroll;
    }

    .question-option {
        border: 1px dotted;
        display: block;
        margin: 10px;
    }

    .question-setting {
        text-align: left;
        position: absolute;
        width: 100px;
    }

    .question-setting-item {

    }

    .right-border {
        border-right: lightgrey 1px solid;
    }

    .margin-bot {
        margin-bottom: 10px;
    }

    .answer-ctrl {
        cursor: pointer;
        margin-left: 5px;
    }

    .empty-question-area {
        padding: 100px 200px 100px 200px;
        border: 1px dotted;
        display: block;
    }

    .big-btn {
        width: 100%;
    }
</style>

