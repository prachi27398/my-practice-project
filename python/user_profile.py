first_name = input("Enter your FirstName : ")
last_name = input("Enter your LastName : ")
age = input("Enter your Age : ")
city = input("Enter your City : ")
occupation = input("Enter your Occupation : ")

full_name = first_name+" "+last_name

profile_desc = f"{full_name} is {age} years old, lives in {city} and works as a {occupation}"

profile_info = "\"Profile Information:\"\n" + profile_desc

modified_name = full_name.upper()
modified_desc = profile_info.replace("a","an") if occupation.startswith(("a","i","e","o","u")) else profile_info

#Display the user Profile
print("User Profile")
print(modified_name)
print(modified_desc)


