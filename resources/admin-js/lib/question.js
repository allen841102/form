export default {
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
    getTypeName(typeId) {
        return this.questionOptions.find(item => {
            return typeId === item.type;
        }).text;
    },
    getClassName(typeId) {
        return this.questionOptions.find(item => {
            return typeId === item.type;
        }).icon;
    }
}
