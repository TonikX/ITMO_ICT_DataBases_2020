db = db.getSiblingDB('school')
db.dropDatabase()

db.classes.insert([{
    _id: 1,
    code: '10 "A"',
    formMaster: 1,
    students: [
        {
            _id: 1,
            fullName: 'Мелькова Элла Марковна',
            gender: 'Жен',
            marks: [
                {
                    subject: 'Математика',
                    mark: 5,
                },
                {
                    subject: 'Информатика',
                    mark: 5,
                },
                {
                    subject: 'Литература',
                    mark: 3,
                }
            ]
        },
        {
            _id: 2,
            fullName: 'Снеткова Екатерина Григорьевна',
            gender: 'Жен',
            marks: [
                {
                    subject: 'Математика',
                    mark: 4,
                },
                {
                    subject: 'Информатика',
                    mark: 5,
                },
                {
                    subject: 'Литература',
                    mark: 4,
                }
            ]
        },
        {
            _id: 3,
            fullName: 'Бессмертный Артём Александрович',
            gender: 'Муж',
            marks: [
                {
                    subject: 'Математика',
                    mark: 3,
                },
                {
                    subject: 'Информатика',
                    mark: 3,
                },
                {
                    subject: 'Литература',
                    mark: 5,
                }
            ]
        }
    ]
},
{
    _id: 2,
    code: '10 "Б"',
    formMaster: 3,
    students: [
        {
            _id: 4,
            fullName: 'Милс Тамара Юрьевна',
            gender: 'Жен',
            marks: [
                {
                    subject: 'Математика',
                    mark: 5,
                },
                {
                    subject: 'Информатика',
                    mark: 5,
                },
                {
                    subject: 'Литература',
                    mark: 4,
                }
            ]
        },
        {
            _id: 5,
            fullName: 'Сокол Ирина Никитична',
            gender: 'Жен',
            marks: [
                {
                    subject: 'Математика',
                    mark: 3,
                },
                {
                    subject: 'Информатика',
                    mark: 4,
                },
                {
                    subject: 'Литература',
                    mark: 2,
                }
            ]
        },
        {
            _id: 6,
            fullName: 'Сокол Антон Никитич',
            gender: 'Муж',
            marks: [
                {
                    subject: 'Математика',
                    mark: 5,
                },
                {
                    subject: 'Информатика',
                    mark: 5,
                },
                {
                    subject: 'Литература',
                    mark: 5,
                }
            ]
        }
    ]
}])

db.timetable.insert([{
    class: 1,
    teacher: {
        _id: 1,
        fullName: 'Клац Марк Юльевич',
        cabinet: 1,
    },
    subject: 'Информатика',
    cabinet: {
        id: 1,
        number: 105,
        isProfile: true,
    },
    day: 'Friday',
    lesson: 1,
},
{
    class: 1,
    teacher: {
        _id: 1,
        fullName: 'Клац Марк Юльевич',
        cabinet: 1,
    },
    subject: 'Информатика',
    cabinet: {
        id: 1,
        number: 105,
        isProfile: true,
    },
    day: 'Friday',
    lesson: 2,
},
{
    class: 1,
    teacher: {
        _id: 2,
        fullName: 'Сямова Анна Владимировна',
        cabinet: null,
    },
    subject: 'Литература',
    cabinet: {
        id: 2,
        number: 210,
        isProfile: false,
    },
    day: 'Friday',
    lesson: 3,
},
{
    class: 1,
    teacher: {
        _id: 2,
        fullName: 'Сямова Анна Владимировна',
        cabinet: null,
    },
    subject: 'Литература',
    cabinet: {
        id: 3,
        number: 215,
        isProfile: false,
    },
    day: 'Friday',
    lesson: 4,
},
{
    class: 1,
    teacher: {
        _id: 3,
        fullName: 'Энов Илья Васильевич',
        cabinet: 4,
    },
    subject: 'Математика',
    cabinet: {
        id: 4,
        number: 110,
        isProfile: true,
    },
    day: 'Friday',
    lesson: 5,
},
{
    class: 2,
    teacher: {
        _id: 3,
        fullName: 'Энов Илья Васильевич',
        cabinet: 4,
    },
    subject: 'Математика',
    cabinet: {
        id: 4,
        number: 110,
        isProfile: true,
    },
    day: 'Friday',
    lesson: 1,
},
{
    class: 2,
    teacher: {
        _id: 3,
        fullName: 'Энов Илья Васильевич',
        cabinet: 4,
    },
    subject: 'Математика',
    cabinet: {
        id: 4,
        number: 110,
        isProfile: true,
    },
    day: 'Friday',
    lesson: 2,
},
{
    class: 2,
    teacher: {
        _id: 4,
        fullName: 'Тутова Надежда Олеговна',
        cabinet: 3,
    },
    subject: 'Литература',
    cabinet: {
        id: 3,
        number: 215,
        isProfile: false,
    },
    day: 'Friday',
    lesson: 3,
},
{
    class: 2,
    teacher: {
        _id: 1,
        fullName: 'Клац Марк Юльевич',
        cabinet: 1,
    },
    subject: 'Информатика',
    cabinet: {
        id: 1,
        number: 105,
        isProfile: true,
    },
    day: 'Friday',
    lesson: 4,
},
{
    class: 2,
    teacher: {
        _id: 1,
        fullName: 'Клац Марк Юльевич',
        cabinet: 1,
    },
    subject: 'Информатика',
    cabinet: {
        id: 1,
        number: 105,
        isProfile: true,
    },
    day: 'Friday',
    lesson: 5,
},
])
