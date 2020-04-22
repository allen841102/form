<template>
<div>
    <el-row>
    <el-col :span="18">
        <div class="grid-content">
            <el-divider content-position="left">基本設定</el-divider>
            <div style="margin: 20px;"></div>
           <el-col :span="22">
            <el-form
                :model="ruleForm"
                label-position="left"
                label-width="120px"
                status-icon
                :rules="rules"
                ref="ruleForm"
                class="demo-ruleForm">
                <el-form-item label="主題" prop="topic">
                    <el-input type="text"
                              placeholder="某某某研究調查"
                              v-model="ruleForm.topic"
                              maxlength="50"
                              show-word-limit
                              clearable></el-input>
                </el-form-item>
                <el-form-item label="開頭說明訊息"  prop="startText">
                    <el-input type="textarea"
                              placeholder="您好，請協助我們了解這次服務的品質，以做為改進的參考。同時我們也將在月底抽出 10 位得獎者，寄發 8 折優惠券。"
                              maxlength="255"
                              show-word-limit
                              v-model="ruleForm.startText"></el-input>
                </el-form-item>
                <el-form-item label="Thank you 訊息" prop="endText">
                    <el-input type="textarea"
                              placeholder="完成，謝謝您的寶貴回饋。祝您有愉快的一天。"
                              maxlength="255"
                              show-word-limit
                              v-model="ruleForm.endText"></el-input>
                </el-form-item>

                <el-divider content-position="left">請從右方區域新增題目</el-divider>

                <draggable :list="questions">
                    <transition-group type="transition" name="question-list">
                        <div class="question-item"
                        v-for="(question, index) in questions" :key="question.sequence">
                    <el-form-item :label=" '題目' + String(index+1) ">
                      <el-col :span="20">
                      <el-input class="question-input"
                                type="text"
                                placeholder="標題"
                                v-model="question.title"
                                clearable>
                      </el-input>
                      </el-col>
                      <el-col :span="3" style="margin-left: 20px;">
                          <el-tag type="warning">
                             {{ getTypeName(question.type)}}
                          </el-tag>
                          <el-tag type="primary" class="sort-btn">
                              <i class="el-icon-rank">排序</i>
                          </el-tag>
                      <el-switch
                            v-model="question.required"
                            :active-text="question.required ? '必填':'選填'">
                      </el-switch>
                      </el-col>
                    </el-form-item>
                    <el-form-item v-if="question.type !== 3"
                                  v-for="(answer, seq) in question.answers"
                                  :key="seq">
                        <el-input type="text"
                                  v-model="question.answers[seq]"
                                  placeholder="請輸入內容"
                                  clearable>
                            <template slot="prepend">答案 {{ seq+1 }}</template>
                        </el-input>
                    </el-form-item>

                    <el-form-item v-if="question.type==3" >
                        <el-input type="text"
                                  disabled>
                        </el-input>
                    </el-form-item>
                </div>
                    </transition-group>
                </draggable>

                <el-form-item>
                    <el-button type="primary" @click="submitForm('ruleForm')">送出</el-button>
<!--                    <el-button @click="resetForm('ruleForm')">Reset</el-button>-->
                </el-form-item>
            </el-form>
           </el-col>
        </div>
    </el-col>
    <el-col :span="6">
        <div class="grid-content bg-purple-light">
            題目類型區域
        </div>
    </el-col>
    </el-row>
</div>
</template>

<script>
    import draggable from 'vuedraggable';
    export default {
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
                ruleForm: {
                    topic: '',
                    startText: '',
                    endText: ''
                },
                rules: {
                    topic: [
                        { validator: validateTopic, trigger: 'blur' }
                    ],
                    startText: [
                        { validator: validateStartText, trigger: 'blur' }
                    ],
                    endText: [
                        { validator: validateEndText, trigger: 'blur' }
                    ]
                },
                questions: [
                    {
                        sequence: 1,
                        title: "這是您第幾次來到本店用餐",
                        type: 1,
                        required: true,
                        answers:[
                            '第 1 次',
                            '第 2 次',
                            '第 3 次',
                            '超過 3 次',
                        ],
                    },
                    {
                        sequence: 2,
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
                        sequence: 3,
                        title: "請留下任何建議",
                        type: 3,
                        required: false,
                        answers:[

                        ],
                    }
                ],
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        alert('submit!');
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            getTypeName(typeId) {
                if(typeId === 1) {
                    return '單選';
                } else if(typeId === 2) {
                    return '多選';
                } else if(typeId === 3) {
                    return '簡答';
                }
                return ''
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
    }
    .sort-btn {
        cursor: all-scroll;
    }
</style>

