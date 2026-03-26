  
  {{-- 🔔 NOTIFICAÇÕES (AGORA CERTO) --}}
    <div class="notifications-box">
        <h3>🔔 Notificações</h3>

        @forelse($notificacoes as $n)
            <div class="notification-item">
                {{ $n->mensagem }}

                <span class="notification-time">
                    {{ $n->created_at->diffForHumans() }}
                </span>
            </div>
        @empty
            <p>Nenhuma notificação</p>
        @endforelse
    </div>