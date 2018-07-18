class Personnage

  attr_accessor :nom, :vie, :force, :vitesse, :type, :potion

  def initialize(nom, potion=0)
    @nom = nom.to_s
    @potion = potion.to_i
  end

  def afficherInfo()
    puts "type : #{@type} \nnom : #{@nom}, vie : #{@vie}, force : #{@force}, vitesse : #{@vitesse}, potion : #{@potion}\n"
  end

  def action(action)
    while monstre.vie >= 1
      puts "Quel action choisissez-vous :"
      action = gets.chomp.to_s
      case action
      when "attaquer"
        perso.attaquer(perso, monstre)
      when "potion"

      else
        puts "Commande incorect Oo"
      end
    end
    puts "Bravo vous avez tuer #{monstre.nom}"
  end

  def attaquer(persoQuiAttaque, persoAAttaquer)
    persoAAttaquer.vie -= persoQuiAttaque.force
    if isDead? (persoAAttaquer.vie)
      return puts "#{persoAAttaquer.nom} est mort"
    end
    return puts "il reste #{persoAAttaquer.vie} à #{persoAAttaquer.nom}"
  end
def isDead?(persoAAttaquer)
  persoAAttaquer >= 0
end
private
def aEsquive? (persoAAttaquer)

end


end
puts "Votre nom de hero : "
perso = Personnage.new(gets.chomp)
puts "Le nom de votre ennemi : "
monstre = Personnage.new(gets.chomp)
system "cls"
puts "Votre personnage : "
perso.vie=100
perso.force = 10
perso.vitesse = 25
perso.type = "Humanoide"
perso.potion = 3
perso.afficherInfo
puts "\n\n Ennemi :"
monstre.vie=50
monstre.force = 5
monstre.vitesse = 30
monstre.type = "deserteur"
monstre.afficherInfo

puts "\nQue voulez-vous faire ?\n-> \t attaquer\n-> \t potion"
Personnage.action(gets.chomp)
