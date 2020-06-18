f1 = ({number: 1})
f2 = ({number: 2})
f3 = ({number: 3})
db.floors.save(f1)
db.floors.save(f2)
db.floors.save(f3)

db.servants.insert([
  {
    firstName: "Анфиса",
    middleName: "Михайловна",
    lastName: "Богуш",
    schedule: {monday: f1, thursday: f3},
    cleaningLogs: [new Date('2020-06-08'), new Date('2020-06-11')]
  },
  {
    firstName: "Михаил",
    middleName: "Анатольевич",
    lastName: "Борисенко",
    schedule: {monday: f2, thursday: f2},
    cleaningLogs: [new Date('2020-06-08'), new Date('2020-06-11')]
  },
  {
    firstName: "Андрей",
    middleName: "Александрович",
    lastName: "Курпатов",
    schedule: {monday: f3, thursday: f1},
    cleaningLogs: [new Date('2020-06-08'), new Date('2020-06-11')]
  },
])

a1 = ({firstName: "Дмитрий", middleName: "Андреевич", lastName: "Пузырев"})
a2 = ({firstName: "Василий", middleName: "Михайлович", lastName: "Пупкин"})
a3 = ({firstName: "Андрей", middleName: "Викторович", lastName: "Назаров"})
db.administrators.save(a1)
db.administrators.save(a2)
db.administrators.save(a3)

c1 = ({firstName: "Александр", middleName: "Васильевич", lastName: "Прохоров", passportNumber: "AC 259411", city: "Москва"})
c2 = ({firstName: "Андрей", middleName: "Михайлович", lastName: "Пингвинин", passportNumber: "BE 544108", city: "Санкт-Петербург"})
c3 = ({firstName: "Анна", middleName: "Михайловна", lastName: "Полякова", passportNumber: "AC 531266", city: "Екатеринбург"})
db.customers.save(c1)
db.customers.save(c2)
db.customers.save(c3)

db.rooms.insert([
  {
    number: 101,
    capacity: 1,
    price: 1000,
    floor: f1,
    livingLogs: [
      {
        customer: c1, 
        administrator: a1, 
        startDate: new Date('2020-06-08'), 
        endDate: new Date('2020-06-10'),
      }
    ]
  },
  {
    number: 201,
    capacity: 3,
    price: 2500,
    floor: f2,
    livingLogs: [
      {
        customer: c1, 
        administrator: a1, 
        startDate: new Date('2020-06-11'), 
        endDate: new Date('2020-06-14'),
      },
      {
        customer: c2,
        administrator: a3,
        startDate: new Date('2020-06-14'),
      },
    ]
  },
  {
    number: 301,
    capacity: 2,
    price: 2000,
    floor: f3,
    livingLogs: [
      {
        customer: c3,
        administrator: a2,
        startDate: new Date('2020-06-08'), 
        endDate: new Date('2020-06-12')
      },
    ]
  }, 
])