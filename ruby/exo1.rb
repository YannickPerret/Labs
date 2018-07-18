puts "Indiquez un palindrome"
motdemander = gets.chomp.downcase
if motdemander == motdemander.reverse
  puts "le mot #{motdemander} est un palindrome"
else
  puts"Le mot de correspond pas"
end
