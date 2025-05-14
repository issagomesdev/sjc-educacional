<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ConteudosCurriculare extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const CAMPO_EIXO_SELECT = [
        'Escrita'              => 'Escrita',
        'Leitura'              => 'Leitura',
        'Letramento Literário' => 'Letramento Literário',
        'Oralidade'            => 'Oralidade',
    ];

    public const BIMESTRES_SELECT = [
        '1' => '1° Bimestre',
        '2' => '2° Bimestre',
        '3' => '3° Bimestre',
        '4' => '4° Bimestre',
    ];

    public const SITUACAO_DIDATICA_SELECT = [
        'Apresentação e solução de problemas'   => 'Apresentação e solução de problemas',
        'Jogos e Matérias Pedagógicos'          => 'Jogos e Matérias Pedagógicos',
        'Maquetes e Croquis'                    => 'Maquetes e Croquis',
        'Textos Escritos'                       => 'Textos Escritos',
        'Debates'                               => 'Debates',
        'Pesquisas'                             => 'Pesquisas',
        'Estudo dirigido'                       => 'Estudo dirigido',
        'Exposição de conteúdo'                 => 'Exposição de conteúdo',
        'Interpretação de texto'                => 'Interpretação de texto',
        'Excursões e visitas'                   => 'Excursões e visitas',
        'Projetos pedagógicos interdisciplinar' => 'Projetos pedagógicos interdisciplinar',
        'Experimentos científicos'              => 'Experimentos científicos',
        'Resolução de exercícios'               => 'Resolução de exercícios',
        'Trabalho em grupo'                     => 'Trabalho em grupo',
        'Outros'                                => 'Outros',
    ];

    public const RECURSO_DIDATICO_SELECT = [
        'Aparelho de DVD'      => 'Aparelho de DVD',
        'Aparelho de SOM'      => 'Aparelho de SOM',
        'Calculadora'          => 'Calculadora',
        'Computador'           => 'Computador',
        'DataShow'             => 'DataShow',
        'EEDUCA'               => 'EEDUCA',
        'Fichas de Exercícios' => 'Fichas de Exercícios',
        'Filmes'               => 'Filmes',
        'Globo Terrestre'      => 'Globo Terrestre',
        'GPS'                  => 'GPS',
        'Jogos Pedagógicos'    => 'Jogos Pedagógicos',
        'Jornais e Revistas'   => 'Jornais e Revistas',
        'Livro Didático'       => 'Livro Didático',
        'Livro Paradidático'   => 'Livro Paradidático',
        'Mapas'                => 'Mapas',
        'Microscópio'          => 'Microscópio',
        'Musicas'              => 'Musicas',
        'Vídeo Aulas'          => 'Vídeo Aulas',
        'Redes Sociais'        => 'Redes Sociais',
        'Sites da WEB'         => 'Sites da WEB',
        'Slides'               => 'Slides',
        'Softwares'            => 'Softwares',
        'Textos Escritos'      => 'Textos Escritos',
        'Vídeos da TV Escola'  => 'Vídeos da TV Escola',
        'Outros'               => 'Outros',
    ];

    public $table = 'conteudos_curriculares';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nivel_de_ensino',
        'disciplina_id',
        'bncc_x_cdp',
        'bncc_id',
        'cdp_id',
        'bimestres',
        'campo_eixo',
        'conteudo',
        'analises_linguisticas',
        'recurso_didatico',
        'situacao_didatica',
        'conteudos_trabalhados',
        'complementos_de_conteudo',
        'team_id',
        'assinatura_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function disciplina()
    {
        return $this->belongsTo(Materium::class, 'disciplina_id');
    }

    public function turmas()
    {
        return $this->belongsTo(Turma::class, 'serie');
    }

    public function bncc()
    {
        return $this->belongsTo(Bncc::class, 'bncc_id');
    }

    public function cdp()
    {
        return $this->belongsTo(CurriculoDePernambuco::class, 'cdp_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function assinatura()
    {
        return $this->belongsTo(User::class, 'assinatura_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
