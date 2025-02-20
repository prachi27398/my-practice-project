#calculates a student's grade based on their test scores and demonstrates the use of various operators.

scores = [84,90,92,81,85]    #list of test score

total_score = sum(scores)   #total scores
num_test = len(scores)      #number of test

average_score = total_score // num_test     #average score

#Determine grade using comparison operator
if average_score >= 90:
    grade = "A"
elif average_score >= 80:
    grade = "B"
elif average_score >= 70:
    grade = "C"
elif average_score >=60:
    grade = "D"
else:
    grade = "F"
    
#Update the grade using assignment operator
if average_score % 10 >= 5:
    grade += "+"
    
# Check if a specific score exists in the list using membership operators
check_score = 90
if check_score in scores:
    print(f"The score {check_score} exists in the list.")
else:
    print(f"The score {check_score} does not exist in the list.")
    
# Compare objects using identity operators
scores_copy = scores
if scores is scores_copy:
    print("The scores and scores_copy are the same object.")
else:
    print("The scores and scores_copy are different objects.")

# Perform bitwise operations on the scores
bitwise_result = scores[0] & scores[1]
print(f"Bitwise AND of the first two scores: {bitwise_result}")

# Display the student's grade
print(f"The student's average score is {average_score} and their grade is {grade}.")
    
