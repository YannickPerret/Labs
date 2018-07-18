=begin
tableau = [1, 2, 6]
tableau.map do |item|
  tableaux = item * 2
  puts tableaux.inspect
end
=end

=begin def demo
  yield "lol"
  puts "Bonjour"
  yield ("pierre")
  puts "Aurevoir"
  yield("Yannick")
end

demo { |nom| puts "Comment ça va #{nom} ? "}
=end
eleves = [
  {note: 10, nom: 'Marine'},
  {note: 4, nom: 'Marc'},
  {note: 10, nom: 'Jean'},
  {note: 12, nom: 'Marion'}
]

def alamoyenne(eleves)

  eleves.each do |eleve|
    if eleve[:note] >= 10
      yield(eleve)
    end
  end
end
affichermoyenne = Proc.new { |eleve|  puts "#{eleve[:nom]} a la moyenne"}

alamoyenne eleves, &affichermoyenne
=begin

alamoyenne(eleves) do |eleve|

  puts "#{eleve[:nom]} a la moyenne"
end
=end
