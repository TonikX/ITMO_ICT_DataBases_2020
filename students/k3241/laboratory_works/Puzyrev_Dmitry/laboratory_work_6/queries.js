// Заполнение БД

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
c4 = ({firstName: "Евгения", middleName: "Михайловна", lastName: "Братонюк", passportNumber: "AC 423422", city: "Санкт-Петербург"})
db.customers.save(c1)
db.customers.save(c2)
db.customers.save(c3)
db.customers.save(c4)

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


// Queries

// Имена клиентов, проживавших в номере с number = 201, начиная с 12 июня 2020 года:
cursor = db.rooms.findOne({number: 201}, {"livingLogs": 1});
  cursor.livingLogs.forEach(function(log) {
  if (log.startDate >= ISODate('2020-06-11')) {
    print(log.customer.firstName)
  }
})


// Количество клиентов по городам:
db.customers.find({city: "Москва"}).count()

db.customers.mapReduce(
  function() { emit(this.city, this.firstName); },
  function(key, values) { return values.length; },
  {
    query: { city: {$exists: true} },
    out: "customer_cities"
  }
)

db.customer_cities.find()

Array.count(values)


// Кто из служащих убирал номер клиента с passportNumber = ‘BE 544108’ 15 июня 2020 года:
cursor = db.rooms.findOne(
{
  "livingLogs.customer.passportNumber": 'BE 544108',
  "livingLogs.startDate": {$lte: ISODate('2020-06-15')},
  $or: [
    {"livingLogs.endDate": null},
    {"livingLogs.endDate": {$gte: ISODate('2020-06-15')}},
  ]
},
{
  floor: 1,
})
db.servants.findOne({"schedule.monday": cursor.floor})


// Количество свободных номеров в гостинице:
db.rooms.find({"livingLogs.endDate": null}).count()



