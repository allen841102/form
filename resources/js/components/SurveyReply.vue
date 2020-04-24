<template>
    <el-container style="height: auto;">
        <el-header>
            <h2>{{ survey.name }}</h2>
        </el-header>
        <el-main>
            <h3>{{ survey.start_text}}</h3>
            <el-form label-position="top" label-width="100px" :model="result">

                <el-form-item :key="index + 1"
                              v-for="(question, index) in result.questions">

                    <span slot="label">
                    <i type="warning" class="" :class="getClassName(question.type)">
                        {{ getTypeName(question.type)}}
                    </i>
                       {{(index + 1 + '. ').toString().concat(question.title)}}
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

                    <el-input v-if="question.type == 3" v-model="question.answer"></el-input>
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
                let {title, id, type_id, answers } = question
                let answer = ''
                if(question.type_id === 2) {
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
                return this.questionOptions.find(item=> {
                    return typeId === item.type;
                }).text;
            },
            getClassName(typeId) {
                return this.questionOptions.find(item=> {
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
</style>
