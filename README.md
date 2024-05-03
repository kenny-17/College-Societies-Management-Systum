# College Society Management System

Welcome to the College Society Management System, a web application designed to streamline the management of college societies, events, and memberships.

## Features
- **User Authentication**: Secure login and registration system for users.
- **Role-Based Access Control**: Distinct functionalities for presidents, members, and general users.
- **Society Management**: Create, update, and manage college societies with ease.
- **Event Management**: Organize and view events hosted by college societies.
- **Membership Management**: Add and remove members from societies with different roles.
- **Dynamic Dashboard**: Personalized dashboard for users based on their roles and memberships.
- **Search Functionality**: Search for events and societies based on various criteria.
- **Public Resources**: Access resources shared by college societies for public consumption.

## Technologies Used
- **Languages**: PHP, HTML, CSS, JavaScript
- **Database**: MySQL
- **Frameworks/Libraries**: None
- **Version Control**: Git

## Schema
The application uses the following database schema:
1. **Users**: UserID (PK), Name, Email, Password
2. **Societies**: SocietyID (PK), Name, Description
3. **Presidents**: PresidentID (PK), UserID (FK), SocietyID (FK)
4. **Memberships**: MembershipID (PK), UserID (FK), SocietyID (FK), Role
5. **Events**: EventID (PK), Name, Description, SocietyID (FK), Date, Location
6. **Registrations**: RegistrationID (PK), UserID (FK), EventID (FK)

## License
This project is licensed under the [Creative Commons Zero v1.0 Universal (CC0-1.0) License](LICENSE), which allows for unrestricted use, distribution, and modification of the codebase, with no attribution required.
