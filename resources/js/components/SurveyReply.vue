<template>
    <el-container class="survey-container">
        <el-header height="auto">
            <h2>{{ survey.name }}</h2>
        </el-header>
        <el-main>
            <h3>{{ survey.start_text}}</h3>
            <el-form :model="result" label-position="top" label-width="100px">

                <el-form-item :key="index + 1"
                              v-for="(question, index) in result.questions">

                    <span slot="label">
                    <span class="question-title">{{(index + 1 + '. ').toString().concat(question.title)}}</span>
                    <i :class="getClassName(question.type)" class="question-type" type="warning"
                       v-if="question.type===2">
                        {{ getTypeName(question.type)}}
                    </i>
                    </span>
                    <el-radio-group v-if="question.type == 1" v-model="question.answer">
                        <el-radio :key="idx + 1"
                                  :label="answer.text"
                                  v-for="(answer, idx) in question.answers">
                        </el-radio>
                    </el-radio-group>

                    <el-checkbox-group v-if="question.type == 2" v-model="question.answer">
                        <el-checkbox :key="idx + 1"
                                     :label="answer.text"
                                     :name="'answer' + (idx + 1).toString()"
                                     v-for="(answer, idx) in question.answers">
                        </el-checkbox>
                    </el-checkbox-group>

                    <el-input v-if="question.type == 3"
                              v-model="question.answer">

                    </el-input>
                </el-form-item>
            </el-form>
        </el-main>
        <el-footer>Footer</el-footer>
    </el-container>
</template>
<script>
    export default {
        props: {
            survey: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                result: {
                    questions: []
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
            }
        },
        created() {
            this.survey.contents.forEach(question => {
                let {title, id, type_id, answers} = question
                let answer = ''
                if (question.type_id === 2) {
                    answer = []
                } else {
                    answer = ''
                }

                this.result.questions.push({title, id, type: type_id, answers, answer})
            })
            console.log(this.result)
        },
        methods: {
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
            handleSubmit() {
                alert("Submit form")
            }
        }
    }
</script>

<style>
    h1, h2 {
        color: rgb(221, 104, 104);
    }
    h3 {
        color: lightgray;
    }

    .el-checkbox__label,
    .el-radio__label {
        font-size: 1.15rem;
        font-weight: bold;
        line-height: 1.5;
        color: rgb(221, 104, 104);
    }
    .el-form-item__content label {
        display: block;
        margin-bottom: 10px;
        border: dotted 1px #a9501c;
        border-radius: 3px;
        padding: 5px;
        width: 100%;
    }

    .question-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: rgb(175, 50, 50);
    }

    .question-type {
        display: block;
        background-color: rgb(255, 239, 204);
        padding: 10px;
        border-radius: 20px;
        border: 1px;
    }

    .survey-container {
        height: auto;
        width: 90%;
        margin: auto;
    }

    .el-input__inner {
        width: 100%;
        font-size: 16px;
        line-height: 1.6;
        border-top-width: initial;
        border-right-width: initial;
        border-left-width: initial;
        border-top-color: initial;
        border-right-color: initial;
        border-left-color: initial;
        box-shadow: none;
        box-sizing: border-box;
        border-style: none none solid;
        border-image: initial;
        border-radius: 0px;
        padding: 5px;
        outline: none;
        border-bottom: 1px solid #cd1900;
    }

    .el-checkbox__input.is-checked .el-checkbox__inner,
    .el-checkbox__input.is-indeterminate .el-checkbox__inner,
    .el-radio__input.is-checked .el-radio__inner {
        border-color: rgb(175, 50, 50);
        background: rgb(175, 50, 50);
    }

    .el-checkbox__input.is-checked+.el-checkbox__label,
    .el-radio__input.is-checked + .el-radio__label {
        color: rgb(175, 50, 50);
    }
</style>
