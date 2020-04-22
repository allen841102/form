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
                label-position="left"
                label-width="120px"
                status-icon
                :rules="rules"
                ref="ruleForm"
                class="demo-ruleForm">
                <el-form-item label="主題" prop="topic">
                    <el-input type="text"
                              placeholder="某某某研究調查"
                              v-model="survey.topic"
                              maxlength="50"
                              show-word-limit
                              clearable></el-input>
                </el-form-item>
                <el-form-item label="開頭說明訊息"  prop="startText">
                    <el-input type="textarea"
                              placeholder="您好，請協助我們了解這次服務的品質，以做為改進的參考。同時我們也將在月底抽出 10 位得獎者，寄發 8 折優惠券。"
                              maxlength="255"
                              show-word-limit
                              v-model="survey.startText"></el-input>
                </el-form-item>
                <el-form-item label="Thank you 訊息" prop="endText">
                    <el-input type="textarea"
                              placeholder="完成，謝謝您的寶貴回饋。祝您有愉快的一天。"
                              maxlength="255"
                              show-word-limit
                              v-model="survey.endText"></el-input>
                </el-form-item>

                <el-divider content-position="left">題目設定</el-divider>

                <draggable :list="survey.questions"
                           group="question-list"
                >
                    <transition-group type="transition" name="question-list">
                        <div class="question-item"
                        v-for="(question, index) in survey.questions" :key="index+1">

                    <el-form-item :label=" '題目' + String(index+1) ">
                            <el-input class="question-input"
                                type="text"
                                placeholder="標題"
                                v-model="question.title"
                                clearable>
                            </el-input>
                    </el-form-item>
                      <div class="question-setting">
                            <el-tag type="warning" class="margin-bot" :class="getClassName(question.type)">
                                {{ getTypeName(question.type)}}
                            </el-tag>
                            <el-tag type="primary" class="sort-btn margin-bot">
                                <i class="el-icon-rank">排序</i>
                            </el-tag>
                          <el-button size="small" type="danger" class="margin-bot" @click="removeQuesiton(index)">
                              <i class="el-icon-delete">刪除</i>
                          </el-button>
                          <el-switch class="margin-bot"
                                v-model="question.required"
                                :active-text="question.required ? '必填':'選填'">
                            </el-switch>
                        </div>
                    <el-form-item v-if="question.type !== 3"
                                  v-for="(answer, seq) in question.answers"
                                  :key="seq">
                        <el-col :span="20">
                            <el-input type="text"
                                  v-model="question.answers[seq]"
                                  placeholder="請輸入內容"
                                  clearable>
                                <template slot="prepend">答案 {{ seq+1 }}</template>
                            </el-input>
                        </el-col>
                        <el-col :span="4" style="text-align: left">
                            <i class="el-icon-plus answer-ctrl" @click="addAnswer(question.answers)"></i>
                            <i class="el-icon-minus answer-ctrl" @click="removeAnswer(question.answers, seq)" v-show="question.answers.length > 1"></i>
                        </el-col>
                    </el-form-item>

                    <el-form-item v-if="question.type==3" >
                        <el-input type="text"
                                  disabled>
                        </el-input>
                    </el-form-item>
                </div>
                    </transition-group>
                </draggable>

                <el-form-item v-show="survey.questions.length > 0">
                    <el-button type="primary" @click="submitForm('ruleForm')">送出</el-button>
<!--                    <el-button @click="resetForm('ruleForm')">Reset</el-button>-->
                </el-form-item>
                <span v-show="survey.questions.length===0" class="empty-question-area"> 請加入題目 </span>
            </el-form>
           </el-col>
        </div>
    </el-col>
    <el-col :span="6">
        <div class="grid-content">
            新增題目類型，拖曳至左方題目設定
            <draggable
                class="dragArea list-group"
                :list="questionOptions"
                :group="{ name: 'question-list', pull: 'clone', put: false }"
                :clone="cloneQuestion"
            >
                <el-button
                    class="question-option"
                    v-for="option in questionOptions"
                    :key="option.type"
                    :icon="option.icon">{{option.text}}</el-button>
            </draggable>
        </div>
    </el-col>
    </el-row>
</div>
</template>

<script>
    import draggable from 'vuedraggable';
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
                    topic: [
                        {validator: validateTopic, trigger: 'blur'}
                    ],
                    startText: [
                        {validator: validateStartText, trigger: 'blur'}
                    ],
                    endText: [
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
                survey: {

                },
            }
       },
       created() {
           if(this.userSurvey) {
               //this.survey = this.userSurvey
               this.survey = {
                   topic: '大學生伙食調查',
                   startText: '您好，這是一份學術研究，僅用於學術使用。針對 18~22 歲的大學生，調查日常三餐的來源與費用。',
                   endText: '謝謝您的協助',
                   questions: [
                       {
                           title: "這是您第幾次來到本店用餐",
                           type: 1,
                           required: true,
                           answers: [
                               '第 1 次',
                               '第 2 次',
                               '第 3 次',
                               '超過 3 次',
                           ],
                       },
                       {
                           title: "請選出您會推薦給朋友或家人的食物",
                           type: 2,
                           required: true,
                           answers: [
                               '義大利麵',
                               '披薩',
                               '燴飯',
                               '甜點',
                               '飲料',
                           ],
                       },
                       {
                           title: "請留下任何建議",
                           type: 3,
                           required: false,
                           answers: [],
                       }
                   ],
               }
           } else {
              this.survey = {
                  topic: '',
                  startText: '',
                  endText: '',
                  questions: [],
              }
           }
       },
       methods: {
            submitForm(formName) {
                console.log(this.survey)
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        alert('submit!' + JSON.stringify(this.survey))
                    } else {
                        console.log('error submit!!')
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields()
            },
            getTypeName(typeId) {
                return this.questionOptions.find(item=> {
                    return typeId === item.type;
                }).text;
            },
            getClassName(typeId) {
                return this.questionOptions.find(item=> {
                    return typeId === item.type;
                }).icon;
            },
            cloneQuestion(questionOption) {
                 let newQuestion = {
                    title: "",
                   type: questionOption.type,
                    required: false,
                    answers: [
                        ''
                    ],
                }
                if (this.survey.questions.length === 0) {
                    this.survey.questions = [newQuestion]
                    return
                }
                return newQuestion
            },
            removeQuesiton(index) {
                this.survey.questions.splice(index, 1)
            },
            addAnswer(answers) {
                answers.push('')
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
    &:last-child {
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
        border-left: 5px groove rgba(28,110,164,0.21);
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
</style>

