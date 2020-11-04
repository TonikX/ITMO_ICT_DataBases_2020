/**
 * 1. Список классных руководителей для каждого класса
 */
db.classes.aggregate([
    {
        '$lookup': {
            'from': 'timetable',
            'let': {
                'teacherId': '$formMaster'
            },
            'pipeline': [
                {
                    '$match': {
                        '$expr': {
                            '$eq': [
                                '$teacher._id', '$$teacherId'
                            ]
                        }
                    }
                }, {
                    '$limit': 1
                }, {
                    '$replaceRoot': {
                        'newRoot': '$teacher'
                    }
                }
            ],
            'as': 'classTeacher'
        }
    }, {
        '$unwind': {
            'path': '$classTeacher'
        }
    }, {
        '$project': {
            'code': 1,
            'formMaster': '$classTeacher.fullName'
        }
    }
])

/**
 * 2. Списки учеников каждого класса
 */
db.classes.aggregate([
    {
        '$project': {
            'students': {
                '$map': {
                    'input': '$students',
                    'as': 'student',
                    'in': '$$student.fullName'
                }
            },
            'code': 1
        }
    }
])

/**
 * 3. Средние оценки каждого ученика
 */
db.classes.aggregate([
    {
        '$unwind': {
            'path': '$students'
        }
    }, {
        '$replaceRoot': {
            'newRoot': '$students'
        }
    }, {
        '$project': {
            'fullName': 1,
            'avgMark': {
                '$avg': '$marks.mark'
            }
        }
    }
])

/**
 * 4. Средние оценки по предметам
 */
db.classes.aggregate([
    {
        '$unwind': {
            'path': '$students'
        }
    }, {
        '$addFields': {
            'marks': '$students.marks'
        }
    }, {
        '$unwind': {
            'path': '$marks'
        }
    }, {
        '$replaceRoot': {
            'newRoot': '$marks'
        }
    }, {
        '$group': {
            '_id': '$subject',
            'avg': {
                '$avg': '$mark'
            }
        }
    }
])

/**
 * 5. Средний балл по школе
 */
db.classes.aggregate([
    {
        '$unwind': {
            'path': '$students'
        }
    }, {
        '$addFields': {
            'marks': '$students.marks.mark'
        }
    }, {
        '$unwind': {
            'path': '$marks'
        }
    }, {
        '$group': {
            '_id': null,
            'avg': {
                '$avg': '$marks'
            }
        }
    }
])

/**
 * 6. Определение профильности предметов на основании кабинетов, в которых по ним проводят занятия
 */
db.timetable.aggregate([
    {
        '$project': {
            'isProfile': '$cabinet.isProfile',
            'subject': 1
        }
    }, {
        '$group': {
            '_id': '$subject',
            'isProfile': {
                '$first': '$isProfile'
            }
        }
    }
])
